<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\Components\SwagImportExport\DbAdapters;

use Shopware\Components\Model\ModelManager;
use Shopware\Components\SwagImportExport\Exception\AdapterException;
use Shopware\Components\SwagImportExport\Utils\SnippetsHelper;
use Shopware\Components\SwagImportExport\Validators\TranslationValidator;
use Shopware\Models\Article\Configurator\Group;
use Shopware\Models\Article\Configurator\Option;
use Shopware\Models\Property\Value;
use Shopware\Models\Shop\Shop;
use Shopware\Models\Translation\Translation;

class TranslationsDbAdapter implements DataDbAdapter
{
    protected $manager;

    protected $configuratorGroupRepo;
    protected $configuratorOptionRepo;

    protected $propertyGroupRepo;
    protected $propertyOptionRepo;
    protected $propertyValueRepo;

    protected $logMessages;

    /**
     * @var string
     */
    protected $logState;

    /** @var TranslationValidator */
    protected $validator;

    /**
     * @return array
     */
    public function readRecordIds($start, $limit, $filter)
    {
        $manager = $this->getManager();

        $builder = $manager->createQueryBuilder();

        $builder->select('t.id');
        $builder->from(Translation::class, 't')
            ->where("t.type = 'propertyvalue'")
            ->orWhere("t.type = 'propertyvalue'")
            ->orWhere("t.type = 'propertyoption'")
            ->orWhere("t.type = 'propertygroup'")
            ->orWhere("t.type = 'configuratoroption'")
            ->orWhere("t.type = 'configuratorgroup'");

        if ($start) {
            $builder->setFirstResult($start);
        }
        if ($limit) {
            $builder->setMaxResults($limit);
        }

        $records = $builder->getQuery()->getResult();

        $result = array_map(
            function ($item) {
                return $item['id'];
            },
            $records
        );

        return $result;
    }

    /**
     * @throws \Exception
     */
    public function read($ids, $columns)
    {
        if (!$ids && empty($ids)) {
            $message = SnippetsHelper::getNamespace()
                ->get('adapters/translations/no_ids', 'Can not read translations without ids.');
            throw new \Exception($message);
        }

        if (!$columns && empty($columns)) {
            $message = SnippetsHelper::getNamespace()
                ->get('adapters/translations/no_column_names', 'Can not read translations without column names.');
            throw new \Exception($message);
        }

        $translations = $this->getTranslations($ids);

        $result['default'] = $this->prepareTranslations($translations);

        return $result;
    }

    /**
     * @return array
     */
    public function prepareTranslations($translations)
    {
        $mapper = $this->getElementMapper();

        $result = [];
        foreach ($translations as $index => $translation) {
            $data = unserialize($translation['objectdata']);

            //key for different translation types
            $key = $mapper[$translation['objecttype']];

            $result[] = [
                'objectKey' => $translation['objectkey'],
                'objectType' => $translation['objecttype'],
                'baseName' => $translation['baseName'],
                'name' => $data[$key],
                'description' => $data['description'],
                'languageId' => $translation['languageId'],
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getDefaultColumns()
    {
        $translation = [
            'objectKey',
            'objectType',
            'baseName',
            'name',
            'description',
            'languageId',
        ];

        return $translation;
    }

    /**
     * @return array
     */
    public function getSections()
    {
        return [
            ['id' => 'default', 'name' => 'default '],
        ];
    }

    /**
     * @param string $section
     *
     * @return bool|mixed
     */
    public function getColumns($section)
    {
        $method = 'get' . ucfirst($section) . 'Columns';

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        return false;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Enlight_Event_Exception
     * @throws \Exception
     */
    public function write($records)
    {
        if (empty($records['default'])) {
            $message = SnippetsHelper::getNamespace()
                ->get('adapters/translations/no_records', 'No translation records were found.');
            throw new \Exception($message);
        }

        $records = Shopware()->Events()->filter(
            'Shopware_Components_SwagImportExport_DbAdapters_TranslationsDbAdapter_Write',
            $records,
            ['subject' => $this]
        );

        $validator = $this->getValidator();
        $importMapper = $this->getElementMapper();
        $translationWriter = Shopware()->Container()->get('translation');

        foreach ($records['default'] as $index => $record) {
            try {
                $record = $validator->filterEmptyString($record);
                $validator->checkRequiredFields($record);
                $validator->validate($record, TranslationValidator::$mapper);

                if (isset($record['languageId'])) {
                    $shop = $this->getManager()->find(Shop::class, $record['languageId']);
                }

                if (!$shop) {
                    $message = SnippetsHelper::getNamespace()
                        ->get('adapters/translations/lang_id_not_found', 'Language with id %s does not exists');
                    throw new AdapterException(sprintf($message, $record['languageId']));
                }

                $repository = $this->getRepository($record['objectType']);

                if (isset($record['objectKey'])) {
                    $element = $repository->findOneBy(['id' => (int) $record['objectKey']]);

                    if (!$element) {
                        $message = SnippetsHelper::getNamespace()
                            ->get('adapters/translations/element_id_not_found', '%s element not found with ID %s');
                        throw new AdapterException(sprintf($message, $record['objectType'], $record['objectKey']));
                    }
                } elseif (isset($record['baseName'])) {
                    $findKey = $record['objectType'] === 'propertyvalue' ? 'value' : 'name';
                    $element = $repository->findOneBy([$findKey => $record['baseName']]);

                    if (!$element) {
                        $message = SnippetsHelper::getNamespace()
                            ->get('adapters/translations/element_baseName_not_found', '%s element not found with name %s');
                        throw new AdapterException(sprintf($message, $record['objectType'], $record['baseName']));
                    }
                }

                if (!$element) {
                    $message = SnippetsHelper::getNamespace()
                        ->get('adapters/translations/element_objectKey_baseName_not_found', 'Please provide objectKey or baseName');
                    throw new AdapterException(sprintf($message));
                }

                $key = $importMapper[$record['objectType']];
                $data[$key] = $record['name'];

                if ($record['objectType'] === 'configuratorgroup') {
                    $data['description'] = $record['description'];
                }

                $translationWriter->write($shop->getId(), $record['objectType'], $element->getId(), $data);

                unset($shop);
                unset($element);
                unset($data);
            } catch (AdapterException $e) {
                $message = $e->getMessage();
                $this->saveMessage($message);
            }
        }
    }

    public function getUnprocessedData()
    {
    }

    /**
     * @throws \Exception
     */
    public function saveMessage($message)
    {
        $errorMode = Shopware()->Config()->get('SwagImportExportErrorMode');

        if ($errorMode === false) {
            throw new \Exception($message);
        }

        $this->setLogMessages($message);
        $this->setLogState('true');
    }

    /**
     * @return array
     */
    public function getLogMessages()
    {
        return $this->logMessages;
    }

    public function setLogMessages($logMessages)
    {
        $this->logMessages[] = $logMessages;
    }

    /**
     * @return string
     */
    public function getLogState()
    {
        return $this->logState;
    }

    public function setLogState($logState)
    {
        $this->logState = $logState;
    }

    /**
     * Returns entity manager
     *
     * @return ModelManager
     */
    public function getManager()
    {
        if ($this->manager === null) {
            $this->manager = Shopware()->Models();
        }

        return $this->manager;
    }

    /**
     * @return \Shopware\Components\Model\QueryBuilder
     */
    public function getBuilder($ids)
    {
        $builder = $this->getManager()->createQueryBuilder();
        $builder->select('translation')
            ->from(Translation::class, 'translation')
            ->where('translation.id IN (:ids)')
            ->setParameter('ids', $ids);

        return $builder;
    }

    /**
     * Returns configurator group repository
     */
    public function getConfiguratorGroupRepository()
    {
        if ($this->configuratorGroupRepo === null) {
            $this->configuratorGroupRepo = $this->getManager()->getRepository(Group::class);
        }

        return $this->configuratorGroupRepo;
    }

    /**
     * Returns configurator option repository
     */
    public function getConfiguratorOptionRepository()
    {
        if ($this->configuratorOptionRepo === null) {
            $this->configuratorOptionRepo = $this->getManager()->getRepository(Option::class);
        }

        return $this->configuratorOptionRepo;
    }

    /**
     * Returns property group repository
     *
     * @return \Shopware\Models\Property\Repository
     */
    public function getPropertyGroupRepository()
    {
        if ($this->propertyGroupRepo === null) {
            $this->propertyGroupRepo = $this->getManager()->getRepository(\Shopware\Models\Property\Group::class);
        }

        return $this->propertyGroupRepo;
    }

    /**
     * Returns property option repository
     *
     * @return \Shopware\Models\Property\Repository
     */
    public function getPropertyOptionRepository()
    {
        if ($this->propertyOptionRepo === null) {
            $this->propertyOptionRepo = $this->getManager()->getRepository(\Shopware\Models\Property\Option::class);
        }

        return $this->propertyOptionRepo;
    }

    /**
     * Returns property value repository
     *
     * @return \Shopware\Models\Property\Repository
     */
    public function getPropertyValueRepository()
    {
        if ($this->propertyValueRepo === null) {
            $this->propertyValueRepo = $this->getManager()->getRepository(Value::class);
        }

        return $this->propertyValueRepo;
    }

    /**
     * @return TranslationValidator
     */
    public function getValidator()
    {
        if ($this->validator === null) {
            $this->validator = new TranslationValidator();
        }

        return $this->validator;
    }

    /**
     * @return array
     */
    protected function getElementMapper()
    {
        return [
            'configuratorgroup' => 'name',
            'configuratoroption' => 'name',
            'propertygroup' => 'groupName',
            'propertyoption' => 'optionName',
            'propertyvalue' => 'optionValue',
        ];
    }

    /**
     * @throws \Zend_Db_Statement_Exception
     *
     * @return array
     */
    protected function getTranslations($ids)
    {
        $articleDetailIds = implode(',', $ids);

        $translationColumns = 'ct.objecttype, ct.objectkey, ct.objectdata as objectdata, ct.objectlanguage as languageId';

        $sql = "(SELECT cgroup.name as baseName, $translationColumns
                FROM `s_core_translations` AS ct

                LEFT JOIN s_article_configurator_groups AS cgroup
                ON cgroup.id = ct.objectkey

                WHERE ct.id IN ($articleDetailIds) AND ct.objecttype = 'configuratorgroup')

                UNION

                (SELECT coptions.name as baseName, $translationColumns
                FROM `s_core_translations` AS ct

                LEFT JOIN s_article_configurator_options AS coptions
                ON coptions.id = ct.objectkey

                WHERE ct.id IN ($articleDetailIds) AND ct.objecttype = 'configuratoroption')

                UNION

                (SELECT pgroup.name as baseName, $translationColumns
                FROM `s_core_translations` AS ct

                LEFT JOIN s_filter AS pgroup
                ON pgroup.id = ct.objectkey

                WHERE ct.id IN ($articleDetailIds) AND ct.objecttype = 'propertygroup')

                UNION

                (SELECT poptions.name as baseName, $translationColumns
                FROM `s_core_translations` AS ct

                LEFT JOIN s_filter_options AS poptions
                ON poptions.id = ct.objectkey

                WHERE ct.id IN ($articleDetailIds) AND ct.objecttype = 'propertyoption')

                UNION

                (SELECT pvalues.value as baseName, $translationColumns
                FROM `s_core_translations` AS ct

                LEFT JOIN s_filter_values AS pvalues
                ON pvalues.id = ct.objectkey

                WHERE ct.id IN ($articleDetailIds) AND ct.objecttype = 'propertyvalue')
                ";

        return Shopware()->Db()->query($sql)->fetchAll();
    }

    /**
     * @throws AdapterException
     *
     * @return \Shopware\Components\Model\ModelRepository
     */
    protected function getRepository($type)
    {
        switch ($type) {
            case 'configuratorgroup':
                return $this->getConfiguratorGroupRepository();
            case 'configuratoroption':
                return $this->getConfiguratorOptionRepository();
            case 'propertygroup':
                return $this->getPropertyGroupRepository();
            case 'propertyoption':
                return $this->getPropertyOptionRepository();
            case 'propertyvalue':
                return $this->getPropertyValueRepository();
            default:
                $message = SnippetsHelper::getNamespace()
                    ->get('adapters/translations/object_type_not_existing', 'Object type %s not existing.');
                throw new AdapterException(sprintf($message, $type));
        }
    }
}

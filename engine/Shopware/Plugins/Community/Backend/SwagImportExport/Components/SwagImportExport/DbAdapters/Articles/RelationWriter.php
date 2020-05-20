<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\Components\SwagImportExport\DbAdapters\Articles;

use Doctrine\DBAL\Connection;
use Enlight_Components_Db_Adapter_Pdo_Mysql as PDOConnection;
use Shopware\Components\SwagImportExport\DbAdapters\ArticlesDbAdapter;
use Shopware\Components\SwagImportExport\Exception\AdapterException;
use Shopware\Components\SwagImportExport\Utils\SnippetsHelper;

class RelationWriter
{
    /**
     * @var ArticlesDbAdapter
     */
    protected $articlesDbAdapter;

    /**
     * @var array
     */
    protected $relationTypes = [
        'similar',
        'accessory',
    ];

    /**
     * @var array
     */
    protected $relationTables = [
        'accessory' => 's_articles_relationships',
        'similar' => 's_articles_similar',
    ];

    protected $table;

    protected $idKey;

    protected $snippetName;

    protected $defaultSnippetMessage;

    /**
     * @var PDOConnection
     */
    protected $db;

    /**
     * @var Connection
     */
    protected $connection;

    public function __construct(ArticlesDbAdapter $articlesDbAdapter)
    {
        $this->articlesDbAdapter = $articlesDbAdapter;
        $this->db = Shopware()->Db();
        $this->connection = Shopware()->Models()->getConnection();
    }

    /**
     * @return ArticlesDbAdapter
     */
    public function getArticlesDbAdapter()
    {
        return $this->articlesDbAdapter;
    }

    /**
     * @param int    $articleId
     * @param string $mainOrderNumber
     * @param array  $relations
     * @param string $relationType
     * @param int    $processedFlag
     *
     * @throws AdapterException
     */
    public function write($articleId, $mainOrderNumber, $relations, $relationType, $processedFlag)
    {
        if (!is_numeric($articleId)) {
            return;
        }

        $this->initializeRelationData($relationType);

        $newRelations = [];
        $allRelations = [];
        foreach ($relations as $relation) {
            //if relation data has only 'parentIndexElement' element
            if (count($relation) < 2) {
                break;
            }

            if ((!isset($relation[$this->idKey]) || !$relation[$this->idKey])
                && (!isset($relation['ordernumber']) || !$relation['ordernumber'])
            ) {
                $this->deleteAllRelations($articleId);
                continue;
            }

            if (isset($relation['ordernumber']) && $relation['ordernumber']) {
                $relationId = $this->getRelationIdByOrderNumber($relation['ordernumber']);

                if (!$relationId && $processedFlag === true) {
                    $message = SnippetsHelper::getNamespace()->get($this->snippetName, $this->defaultSnippetMessage);
                    throw new AdapterException(sprintf($message, $relation['ordernumber']));
                }

                if (!$relationId) {
                    $data = [
                        'articleId' => $mainOrderNumber,
                        'ordernumber' => $relation['ordernumber'],
                    ];

                    $this->getArticlesDbAdapter()->saveUnprocessedData(
                        'articles',
                        strtolower($relationType),
                        $mainOrderNumber,
                        $data
                    );
                    continue;
                }

                $relation[$this->idKey] = $relationId;
            }

            if (!$this->isRelationIdExists($relation[$this->idKey])) {
                continue;
            }

            if (!$this->isRelationExists($relation[$this->idKey], $articleId)) {
                $newRelations[] = $relation;
            }

            $allRelations[] = $relation;
        }

        if ($allRelations && !$processedFlag) {
            //delete the relations that don't exist in the csv file, but exist in the db"
            $this->deleteRelations($allRelations, $articleId);
        }

        if ($newRelations) {
            $this->insertRelations($newRelations, $articleId); //insert only new relations
        }
    }

    /**
     * Checks whether the relation type exists.
     * Sets the table name.
     * Sets the idKey used to access relation's id. Example: accessory - $relation['accessoryId'],
     * similar - $relation['similarId']
     *
     * @param string $relationType
     */
    protected function initializeRelationData($relationType)
    {
        $this->checkRelation($relationType);

        $this->table = $this->relationTables[$relationType];
        $this->idKey = strtolower($relationType) . 'Id';
        $this->snippetName = 'adapters/articles/' . strtolower($relationType) . '_not_found';
        $this->defaultSnippetMessage = ucfirst($relationType) . ' with ordernumber %s does not exists';
    }

    /**
     * Checks whether the relation type exists.
     *
     * @param string $relationType
     *
     * @throws \Exception
     */
    protected function checkRelation($relationType)
    {
        if (!in_array($relationType, $this->relationTypes)) {
            $message = "Wrong relation type is used! Allowed types are: 'accessory' or 'similar'";
            throw new \Exception($message);
        }
    }

    /**
     * Gets relation id by orderNumber.
     *
     * @param string $orderNumber
     *
     * @return string
     */
    protected function getRelationIdByOrderNumber($orderNumber)
    {
        $relationId = $this->db->fetchOne(
            'SELECT articleID FROM s_articles_details WHERE ordernumber = ?',
            [$orderNumber]
        );

        return $relationId;
    }

    /**
     * Checks whether this article exists.
     *
     * @return bool
     */
    protected function isRelationIdExists($relationId)
    {
        $articleId = $this->db->fetchOne(
            'SELECT articleID FROM s_articles_details WHERE articleID = ?',
            [$relationId]
        );

        return is_numeric($articleId);
    }

    /**
     * Checks whether this relation exists.
     *
     * @return bool
     */
    protected function isRelationExists($relationId, $articleId)
    {
        $isRelationExists = $this->db->fetchOne(
            "SELECT id FROM {$this->table} WHERE relatedarticle = ? AND articleID = ?",
            [$relationId, $articleId]
        );

        return is_numeric($isRelationExists);
    }

    /**
     * Deletes all relations.
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    private function deleteAllRelations($articleId)
    {
        $delete = "DELETE FROM {$this->table} WHERE articleID = {$articleId}";
        $this->connection->exec($delete);
    }

    /**
     * Deletes unnecessary relations.
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    private function deleteRelations($relations, $articleId)
    {
        $relatedIds = implode(
            ', ',
            array_map(
                function ($relation) {
                    return $relation[$this->idKey];
                },
                $relations
            )
        );

        $delete = "DELETE FROM {$this->table} WHERE articleID = {$articleId} AND relatedarticle NOT IN ({$relatedIds})";
        $this->connection->exec($delete);
    }

    /**
     * Inserts new relations.
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    private function insertRelations($relations, $articleId)
    {
        $values = implode(
            ', ',
            array_map(
                function ($relation) use ($articleId) {
                    return "({$articleId}, {$relation[$this->idKey]})";
                },
                $relations
            )
        );

        $insert = "INSERT INTO {$this->table} (articleID, relatedarticle) VALUES {$values}";
        $this->connection->exec($insert);
    }
}

<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Functional\Controllers\Backend\SwagImportExport;

use Shopware\Components\Model\ModelManager;
use Shopware\CustomModels\ImportExport\Profile;
use SwagImportExport\Tests\Helper\DatabaseTestCaseTrait;
use SwagImportExport\Tests\Helper\ExportControllerTrait;

class AddressExportTest extends \Enlight_Components_Test_Controller_TestCase
{
    use ExportControllerTrait;
    use DatabaseTestCaseTrait;

    public function setUp(): void
    {
        parent::setUp();

        Shopware()->Plugins()->Backend()->Auth()->setNoAuth();
        Shopware()->Plugins()->Backend()->Auth()->setNoAcl();
    }

    public function test_address_export_with_xml()
    {
        $params = $this->getExportRequestParams();

        /** @var ModelManager $modelManager */
        $modelManager = Shopware()->Container()->get('models');
        $repo = $modelManager->getRepository(Profile::class);
        $profile = $repo->findOneBy(['name' => 'default_addresses']);

        $params['profileId'] = $profile->getId();
        $params['format'] = 'xml';

        $this->Request()->setParams($params);
        $this->dispatch('backend/SwagImportExportExport/export');

        $assigned = $this->View()->getAssign('data');

        $fileName = $assigned['fileName'];
        $file = $this->uploadPathProvider->getRealPath($fileName);

        static::assertFileExists($file);
        $this->backendControllerTestHelper->addFile($file);

        $company = $this->queryXpath($file, "//address[company='Muster GmbH']/company");
        static::assertEquals('Muster GmbH', $company->item(0)->nodeValue);

        $company = $this->queryXpath($file, "//address[company='Muster GmbH']/firstname");
        static::assertEquals('Max', $company->item(0)->nodeValue);
    }

    public function test_address_export_with_csv()
    {
        $params = $this->getExportRequestParams();

        /** @var ModelManager $modelManager */
        $modelManager = Shopware()->Container()->get('models');
        $repo = $modelManager->getRepository(Profile::class);
        $profile = $repo->findOneBy(['name' => 'default_addresses']);

        $params['profileId'] = $profile->getId();
        $params['format'] = 'csv';
        $this->Request()->setParams($params);

        $this->dispatch('backend/SwagImportExportExport/export');
        $assigned = $this->View()->getAssign('data');

        $fileName = $assigned['fileName'];
        $file = $this->uploadPathProvider->getRealPath($fileName);

        static::assertFileExists($file);
        $this->backendControllerTestHelper->addFile($file);

        $exportedAddresses = $this->csvToArrayIndexedByFieldValue($file, 'id');

        static::assertEquals($exportedAddresses[1]['company'], 'Muster GmbH');
        static::assertEquals($exportedAddresses[1]['firstname'], 'Max');
        static::assertEquals($exportedAddresses[1]['lastname'], 'Mustermann');
    }
}

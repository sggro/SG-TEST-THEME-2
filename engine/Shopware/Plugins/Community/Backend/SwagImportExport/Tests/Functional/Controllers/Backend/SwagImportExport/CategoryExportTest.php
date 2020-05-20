<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Functional\Controllers\Backend\SwagImportExport;

use SwagImportExport\Tests\Helper\DatabaseTestCaseTrait;
use SwagImportExport\Tests\Helper\DataProvider\ProfileDataProvider;
use SwagImportExport\Tests\Helper\ExportControllerTrait;
use SwagImportExport\Tests\Helper\FixturesImportTrait;

class CategoryExportTest extends \Enlight_Components_Test_Controller_TestCase
{
    use FixturesImportTrait;
    use DatabaseTestCaseTrait;
    use ExportControllerTrait;

    const FORMAT_XML = 'xml';
    const FORMAT_CSV = 'csv';

    public function setUp(): void
    {
        parent::setUp();

        Shopware()->Plugins()->Backend()->Auth()->setNoAuth();
        Shopware()->Plugins()->Backend()->Auth()->setNoAcl();
    }

    public function test_category_xml_export()
    {
        $params = $this->getExportRequestParams();
        $params['profileId'] = $this->backendControllerTestHelper->getProfileIdByType(ProfileDataProvider::CATEGORY_PROFILE_TYPE);
        $params['format'] = self::FORMAT_XML;
        $this->Request()->setParams($params);

        $this->dispatch('backend/SwagImportExportExport/export');
        $assigned = $this->View()->getAssign('data');

        $fileName = $assigned['fileName'];
        $filePath = $this->uploadPathProvider->getRealPath($fileName);

        static::assertFileExists($filePath, "File not found {$fileName}");
        $this->backendControllerTestHelper->addFile($filePath);

        $this->assertCategoryAttributeInXml($filePath, '5', 'name', 'Genusswelten');
        $this->assertCategoryAttributeInXml($filePath, '3', 'name', 'Deutsch');

        $categoryNodeList = $this->queryXpath($filePath, '//category');
        static::assertEquals(62, $categoryNodeList->length);
    }

    public function test_category_csv_export()
    {
        $params = $this->getExportRequestParams();
        $params['profileId'] = $this->backendControllerTestHelper->getProfileIdByType(ProfileDataProvider::CATEGORY_PROFILE_TYPE);
        $params['format'] = self::FORMAT_CSV;
        $this->Request()->setParams($params);

        $this->dispatch('backend/SwagImportExportExport/export');
        $assigned = $this->View()->getAssign('data');

        $fileName = $assigned['fileName'];
        $file = $this->uploadPathProvider->getRealPath($fileName);

        static::assertFileExists($file, "File not found {$fileName}");
        $this->backendControllerTestHelper->addFile($file);

        $mappedCategoryCsv = $this->csvToArrayIndexedByFieldValue($file, 'categoryId');

        static::assertEquals('Deutsch', $mappedCategoryCsv[3]['name']);
        static::assertEquals(1, $mappedCategoryCsv[3]['parentID'], 'Category Deutsch has no parent category.');
    }

    /**
     * @param string $filePath
     * @param string $categoryId
     * @param string $attribute
     * @param string $expected
     */
    private function assertCategoryAttributeInXml($filePath, $categoryId, $attribute, $expected)
    {
        $categoryNodeList = $this->queryXpath($filePath, "//category[categoryId='{$categoryId}']/{$attribute}");
        $nodeValue = $categoryNodeList->item(0)->nodeValue;
        static::assertEquals($expected, $nodeValue);
    }
}

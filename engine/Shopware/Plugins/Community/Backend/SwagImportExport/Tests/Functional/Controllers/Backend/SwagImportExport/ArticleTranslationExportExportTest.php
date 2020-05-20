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

class ArticleTranslationExportExportTest extends \Enlight_Components_Test_Controller_TestCase
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

    public function test_articles_translations_xml_export()
    {
        $params = $this->getExportRequestParams();
        $params['profileId'] = $this->backendControllerTestHelper->getProfileIdByType(ProfileDataProvider::ARTICLES_TRANSLATIONS_PROFILE_TYPE);
        $params['format'] = self::FORMAT_XML;
        $this->Request()->setParams($params);

        $this->dispatch('backend/SwagImportExportExport/export');
        $assigned = $this->View()->getAssign('data');

        $fileName = $assigned['fileName'];
        $file = $this->uploadPathProvider->getRealPath($fileName);

        static::assertFileExists($file, "File not found {$fileName}");
        $this->backendControllerTestHelper->addFile($file);

        $this->assertTranslationAttributeInXml($file, 'SW10002.3', 'name', 'Munsterland Lagerkorn 32%');
        $this->assertTranslationAttributeInXml($file, 'SW10002.3', 'languageId', '2');
    }

    public function test_articles_translations_csv_export()
    {
        $params = $this->getExportRequestParams();
        $params['profileId'] = $this->backendControllerTestHelper->getProfileIdByType(ProfileDataProvider::ARTICLES_TRANSLATIONS_PROFILE_TYPE);
        $params['format'] = self::FORMAT_CSV;
        $this->Request()->setParams($params);

        $this->dispatch('backend/SwagImportExportExport/export');
        $assigned = $this->View()->getAssign('data');

        $fileName = $assigned['fileName'];
        $file = $this->uploadPathProvider->getRealPath($fileName);

        static::assertFileExists($file, "File not found {$fileName}");
        $this->backendControllerTestHelper->addFile($file);

        $mappedTranslationList = $this->csvToArrayIndexedByFieldValue($file, 'articlenumber');
        static::assertEquals('Munsterland Lagerkorn 32%', $mappedTranslationList['SW10002.3']['name']);
        static::assertEquals(2, $mappedTranslationList['SW10002.3']['languageId']);
    }

    /**
     * @param string $filePath
     * @param string $orderNumber
     * @param string $attribute
     * @param string $expected
     */
    private function assertTranslationAttributeInXml($filePath, $orderNumber, $attribute, $expected)
    {
        $translationNodeList = $this->queryXpath($filePath, "//Translation[articlenumber='{$orderNumber}']/{$attribute}");
        $nodeValue = $translationNodeList->item(0)->nodeValue;
        static::assertEquals($expected, $nodeValue);
    }
}

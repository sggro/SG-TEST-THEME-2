<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Functional\Commands;

use Doctrine\DBAL\Connection;
use ImportExportTestKernel;
use PHPUnit\Framework\TestCase;
use SwagImportExport\Tests\Helper\CommandTestCaseTrait;
use SwagImportExport\Tests\Helper\DatabaseTestCaseTrait;
use SwagImportExport\Tests\Helper\DataProvider\ProfileDataProvider;
use SwagImportExport\Tests\Helper\FixturesImportTrait;

class ImportCommandTest extends TestCase
{
    use FixturesImportTrait;
    use CommandTestCaseTrait;
    use DatabaseTestCaseTrait;

    const CLI_IMPORT_COMMAND = 'sw:importexport:import -p';

    /**
     * @var Connection
     */
    private $connection;

    public function setUp(): void
    {
        $this->connection = Shopware()->Container()->get('dbal_connection');
    }

    public function testCustomerXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::CUSTOMER_TABLE);
        $customerProfileName = 'default_customers';
        $importFilePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'CustomerImport.xml';
        $expectedImportedCustomersAmount = 4;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$customerProfileName} {$importFilePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::CUSTOMER_TABLE);
        $importedCustomersAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedCustomersAmount}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedCustomersAmount, $importedCustomersAmount);
    }

    public function testCustomerCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::CUSTOMER_TABLE);
        $customerProfileName = 'default_customers';
        $importFilePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'CustomerImport.csv';
        $expectedImportedCustomersAmount = 4;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$customerProfileName} {$importFilePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::CUSTOMER_TABLE);
        $importedCustomersAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedCustomersAmount}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedCustomersAmount, $importedCustomersAmount);
    }

    public function testCategoryXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::CATEGORY_TABLE);
        $categoryProfileName = 'default_categories';
        $importFilePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'CategoriesImport.xml';
        $expectedImportedCategories = 16;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$categoryProfileName} {$importFilePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::CATEGORY_TABLE);
        $importedCategoriesAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedCategories}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedCategories, $importedCategoriesAmount);
    }

    public function testCategoryCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::CATEGORY_TABLE);
        $profile = 'default_categories';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'CategoriesImport.csv';
        $expectedImportedCategories = 16;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::CATEGORY_TABLE);
        $importedCategoriesAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedCategories}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedCategories, $importedCategoriesAmount);
    }

    public function testNewsletterRecipientXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::NEWSLETTER_TABLE);
        $profile = 'default_newsletter_recipient';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'NewsletterRecipientImport.xml';
        $expectedImportedNewsletterRecipients = 6;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::NEWSLETTER_TABLE);
        $importedNewsletterAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedNewsletterRecipients}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedNewsletterRecipients, $importedNewsletterAmount);
    }

    public function testNewsletterRecipientCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::NEWSLETTER_TABLE);
        $profile = 'default_newsletter_recipient';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'NewsletterRecipientImport.csv';
        $expectedImportedNewsletterRecipients = 6;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::NEWSLETTER_TABLE);
        $importedNewsletterAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedNewsletterRecipients}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedNewsletterRecipients, $importedNewsletterAmount);
    }

    public function testArticleXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::ARTICLE_TABLE);
        $profile = 'default_articles';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'ArticleImport.xml';
        $expectedImportedArticles = 2;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::ARTICLE_TABLE);
        $importedArticlesAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedArticles}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedArticles, $importedArticlesAmount);
    }

    public function testArticleCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::ARTICLE_TABLE);
        $profile = 'default_articles';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'ArticleImport.csv';
        $expectedImportedArticles = 2;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::ARTICLE_TABLE);
        $importedArticlesAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedArticles}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedArticles, $importedArticlesAmount);
    }

    public function testVariantXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::VARIANT_TABLE);
        $profile = 'default_article_variants_minimal';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'VariantsImport.xml';
        $expectedImportedVariants = 2;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::VARIANT_TABLE);
        $importedVariantsAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals("Total count: {$expectedImportedVariants}.", $consoleOutput[3]);
        static::assertEquals($expectedImportedVariants, $importedVariantsAmount);
    }

    public function testVariantCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::VARIANT_TABLE);
        $profile = 'default_article_variants_minimal';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'VariantsImport.csv';
        $expectedImportedVariants = 2;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::VARIANT_TABLE);
        $importedVariantsAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals('Using format: csv.', $consoleOutput[1], 'Returned not the expected export file format.');
        static::assertEquals("Total count: {$expectedImportedVariants}.", $consoleOutput[3], 'Did not processed the expected amount of data rows.');
        static::assertEquals($expectedImportedVariants, $importedVariantsAmount, 'Expected 2 new rows in s_articles_details.');
    }

    public function testArticleInStockXmlImport()
    {
        $profile = 'default_article_in_stock';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'ArticleInStockImport.xml';

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals('Total count: 405.', $consoleOutput[3]);
    }

    public function testArticleInStockCsvImport()
    {
        $profile = 'default_article_in_stock';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'ArticleInStockImport.csv';

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals('Total count: 405.', $consoleOutput[3]);
    }

    public function testArticlePriceXmlImport()
    {
        $profile = 'default_article_prices';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'ArticlePricesImport.xml';

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals('Total count: 27.', $consoleOutput[3]);
    }

    public function testArticlePriceCsvImport()
    {
        $profile = 'default_article_prices';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'ArticlePricesImport.csv';

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals('Total count: 98.', $consoleOutput[3]);
    }

    public function testArticleTranslationXmlImport()
    {
        $profile = 'default_article_translations';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'ArticleTranslationImport.xml';

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals('Total count: 103.', $consoleOutput[3]);
    }

    public function testArticleTranslationCsvImport()
    {
        $profile = 'default_article_translations';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'ArticleTranslationImport.csv';

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals('Total count: 103.', $consoleOutput[3]);
    }

    public function testOrderXmlImport()
    {
        $profile = 'default_orders_minimal';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'OrderImport.xml';
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::ORDER_TABLE);
        $expectedImportedOrders = 0;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::ORDER_TABLE);
        $importedOrdersAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals($expectedImportedOrders, $importedOrdersAmount);
        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals('Total count: 17.', $consoleOutput[3]);
    }

    public function testOrderCsvImport()
    {
        $profile = 'default_orders_minimal';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'OrderImport.csv';
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::ORDER_TABLE);
        $expectedImportedOrders = 0;

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::ORDER_TABLE);
        $importedOrdersAmount = $resultLineAmount - $actualLineAmount;

        static::assertEquals($expectedImportedOrders, $importedOrdersAmount);
        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals('Total count: 17.', $consoleOutput[3]);
    }

    public function testMainOrderXmlImport()
    {
        $profile = 'default_order_main_data';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'MainOrderImport.xml';

        $this->expectException(\Exception::class);
        $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");
    }

    public function testMainOrderCsvImport()
    {
        $profile = 'default_order_main_data';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'MainOrderImport.csv';

        $this->expectException(\Exception::class);
        $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");
    }

    public function testTranslationXmlImport()
    {
        $profile = 'default_system_translations';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'TranslationImport.xml';

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        static::assertEquals('Using format: xml.', $consoleOutput[1]);
        static::assertEquals('Total count: 15.', $consoleOutput[3]);
    }

    public function testTranslationCsvImport()
    {
        $profile = 'default_system_translations';
        $filePath = ImportExportTestKernel::IMPORT_FILES_DIR . 'TranslationImport.csv';

        $consoleOutput = $this->runCommand(self::CLI_IMPORT_COMMAND . " {$profile} {$filePath}");

        static::assertEquals('Using format: csv.', $consoleOutput[1]);
        static::assertEquals('Total count: 15.', $consoleOutput[3]);
    }

    /**
     * @param string $table
     *
     * @return int
     */
    private function getRowCountForTable($table)
    {
        $statement = $this->connection->executeQuery("SELECT * FROM {$table}");

        return $statement->rowCount();
    }
}

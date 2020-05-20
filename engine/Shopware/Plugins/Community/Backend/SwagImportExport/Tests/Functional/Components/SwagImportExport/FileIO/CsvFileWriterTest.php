<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SawgImportExport\Tests\Functional\Components\SwagImportExport\FileIO;

use PHPUnit\Framework\TestCase;
use Shopware\Components\SwagImportExport\FileIO\CsvFileWriter;
use Shopware\Components\SwagImportExport\Utils\FileHelper;

class CsvFileWriterTest extends TestCase
{
    const TEST_FILE = __DIR__ . '/test.csv';

    protected function tearDown(): void
    {
        unlink(self::TEST_FILE);
    }

    public function test_it_should_create_csv()
    {
        $exampleData = [['row1-column1', 'row1-column2']];

        $csvFileWriter = $this->createCsvFileWriter();
        $csvFileWriter->writeRecords(self::TEST_FILE, $exampleData);

        static::assertFileEquals(__DIR__ . '/_fixtures/created_csv_file.csv', self::TEST_FILE);
    }

    /**
     * @return CsvFileWriter
     */
    private function createCsvFileWriter()
    {
        return new CsvFileWriter(new FileHelper());
    }
}

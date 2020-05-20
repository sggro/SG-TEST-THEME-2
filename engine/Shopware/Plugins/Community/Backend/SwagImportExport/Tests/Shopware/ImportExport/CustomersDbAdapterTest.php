<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Shopware\ImportExport;

use Tests\Helper\DbAdapterTestHelper;

class CustomersDbAdapterTest extends DbAdapterTestHelper
{
    protected $yamlFile = 'TestCases/customersDbAdapter.yml';

    public function setUp(): void
    {
        parent::setUp();

        $this->dbAdapter = 'customers';
        $this->dbTable = 's_user';
    }

    /**
     * @param array $columns
     * @param int[] $ids
     * @param array $expected
     * @param int   $expectedCount
     *
     * @dataProvider readProvider
     */
    public function testRead($columns, $ids, $expected, $expectedCount)
    {
        $this->read($columns, $ids, $expected, $expectedCount);
    }

    /**
     * @return array
     */
    public function readProvider()
    {
        return $this->getDataProvider('testRead');
    }

    /**
     * @param int   $start
     * @param array $limit
     * @param int[] $expectedIds
     * @param int   $expectedCount
     *
     * @dataProvider readRecordIdsProvider
     */
    public function testReadRecordIds($start, $limit, $expectedIds, $expectedCount)
    {
        $this->readRecordIds($start, $limit, [], $expectedIds, $expectedCount);
    }

    /**
     * @return array
     */
    public function readRecordIdsProvider()
    {
        return $this->getDataProvider('testReadRecordIds');
    }

    /**
     * @dataProvider writeWithEmptyFile
     */
    public function testWriteWithEmptyFile($records, $expectedInsertedRows)
    {
        self::expectException(\Exception::class);

        $this->write($records, $expectedInsertedRows);
    }

    /**
     * @return array
     */
    public function writeWithEmptyFile()
    {
        return $this->getDataProvider('writeWithEmptyFile');
    }

    /**
     * @param array $records
     * @param int   $expectedInsertedRows
     *
     * @dataProvider writeProvider
     */
    public function testWrite($records, $expectedInsertedRows)
    {
        $this->write($records, $expectedInsertedRows);
    }

    /**
     * @return array
     */
    public function writeProvider()
    {
        return $this->getDataProvider('testWrite');
    }
}

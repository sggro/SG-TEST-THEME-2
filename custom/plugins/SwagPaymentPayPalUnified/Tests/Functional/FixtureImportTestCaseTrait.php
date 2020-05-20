<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Tests\Functional;

use Doctrine\DBAL\Connection;

trait FixtureImportTestCaseTrait
{
    protected function importFixturesBefore()
    {
        /** @var Connection $connection */
        $connection = Shopware()->Container()->get('dbal_connection');
        $connection->exec(file_get_contents(__DIR__ . '/order_fixtures.sql'));
    }
}

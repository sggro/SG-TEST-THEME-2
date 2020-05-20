<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Tests\Functional\WebhookHandler;

use Shopware\Components\Model\ModelManager;

class EntityManagerMock extends ModelManager
{
    public function __construct()
    {
    }

    public function getRepository($entityName)
    {
        throw new \RuntimeException('Test exception');
    }
}

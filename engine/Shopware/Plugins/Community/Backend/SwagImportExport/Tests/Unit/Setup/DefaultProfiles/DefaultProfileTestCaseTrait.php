<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Unit\Setup\DefaultProfiles;

trait DefaultProfileTestCaseTrait
{
    /**
     * @param callable $callable - Callable with assertions which will be executed on every array
     */
    private function walkRecursive(array $item, callable $callable)
    {
        $callable($item);

        if (isset($item['children'])) {
            foreach ($item['children'] as $child) {
                $this->walkRecursive($child, $callable);
            }
        }
    }
}

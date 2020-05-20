<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\Components\SwagImportExport\Transformers;

/**
 * This interface defines the way the transformers must work.
 * Each of them must be able to compose headers and footers, and to transform the data in both directions.
 */
interface DataTransformerAdapter
{
    /**
     * Sets the main config which defines the data restructuring
     */
    public function initialize($config);

    /**
     * Transforms the data in direction to formatted output file and returns the transformed data.
     *
     * @return array
     */
    public function transformForward($data);

    /**
     * Transforms the data in direction from formatted output file and returns the transformed data.
     *
     * @return array
     */
    public function transformBackward($data);
}

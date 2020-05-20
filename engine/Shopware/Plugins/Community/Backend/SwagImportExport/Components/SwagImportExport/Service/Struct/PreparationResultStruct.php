<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\Components\SwagImportExport\Service\Struct;

class PreparationResultStruct
{
    /** @var int */
    private $position;

    /** @var int */
    private $totalResultCount;

    /**
     * @param int $position
     * @param int $totalResultCount
     */
    public function __construct($position, $totalResultCount)
    {
        $this->position = $position;
        $this->totalResultCount = $totalResultCount;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getTotalResultCount()
    {
        return $this->totalResultCount;
    }
}

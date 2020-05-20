<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\Components\SwagImportExport\DbAdapters\Results;

class ArticleWriterResult
{
    /**
     * @var int
     */
    private $articleId;

    /**
     * @var int
     */
    private $mainDetailId;

    /**
     * @var int
     */
    private $detailId;

    /**
     * @param int $articleId
     * @param int $mainDetailId
     * @param int $detailId
     */
    public function __construct($articleId, $mainDetailId, $detailId)
    {
        $this->articleId = $articleId;
        $this->mainDetailId = $mainDetailId;
        $this->detailId = $detailId;
    }

    /**
     * @return int
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @return int
     */
    public function getMainDetailId()
    {
        return $this->mainDetailId;
    }

    /**
     * @return int
     */
    public function getDetailId()
    {
        return $this->detailId;
    }
}

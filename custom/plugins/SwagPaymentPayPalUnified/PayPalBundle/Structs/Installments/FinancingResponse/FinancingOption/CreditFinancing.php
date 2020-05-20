<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\PayPalBundle\Structs\Installments\FinancingResponse\FinancingOption;

use SwagPaymentPayPalUnified\PayPalBundle\Structs\Common\Link;

class CreditFinancing
{
    /**
     * @var string
     */
    private $financingCode;

    /**
     * @var float
     */
    private $apr;

    /**
     * @var float
     */
    private $nominalRate;

    /**
     * @var int
     */
    private $term;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $creditType;

    /**
     * @var string
     */
    private $vendorFinancingId;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @var Link[]
     */
    private $links;

    /**
     * @return string
     */
    public function getFinancingCode()
    {
        return $this->financingCode;
    }

    /**
     * @param string $financingCode
     */
    public function setFinancingCode($financingCode)
    {
        $this->financingCode = $financingCode;
    }

    /**
     * @return float
     */
    public function getApr()
    {
        return $this->apr;
    }

    /**
     * @param float $apr
     */
    public function setApr($apr)
    {
        $this->apr = $apr;
    }

    /**
     * @return float
     */
    public function getNominalRate()
    {
        return $this->nominalRate;
    }

    /**
     * @param float $nominalRate
     */
    public function setNominalRate($nominalRate)
    {
        $this->nominalRate = $nominalRate;
    }

    /**
     * @return int
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param int $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getCreditType()
    {
        return $this->creditType;
    }

    /**
     * @param string $creditType
     */
    public function setCreditType($creditType)
    {
        $this->creditType = $creditType;
    }

    /**
     * @return string
     */
    public function getVendorFinancingId()
    {
        return $this->vendorFinancingId;
    }

    /**
     * @param string $vendorFinancingId
     */
    public function setVendorFinancingId($vendorFinancingId)
    {
        $this->vendorFinancingId = $vendorFinancingId;
    }

    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return Link[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param Link[] $links
     */
    public function setLinks($links)
    {
        $this->links = $links;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $links = [];
        foreach ($this->getLinks() as $link) {
            $links[] = $link->toArray();
        }

        return [
            'financingCode' => $this->getFinancingCode(),
            'apr' => $this->getApr(),
            'nominalRate' => $this->getNominalRate(),
            'term' => $this->getTerm(),
            'countryCode' => $this->getCountryCode(),
            'creditType' => $this->getCreditType(),
            'vendorFinancingId' => $this->getVendorFinancingId(),
            'enabled' => $this->getEnabled(),
            'links' => $links,
        ];
    }

    /**
     * @return CreditFinancing
     */
    public static function fromArray(array $data = [])
    {
        $creditFinancing = new self();
        $creditFinancing->setFinancingCode($data['financing_code']);
        $creditFinancing->setApr((float) $data['apr']);
        $creditFinancing->setNominalRate((float) $data['nominal_rate']);
        $creditFinancing->setTerm($data['term']);
        $creditFinancing->setCountryCode($data['country_code']);
        $creditFinancing->setCreditType($data['credit_type']);
        $creditFinancing->setVendorFinancingId($data['vendor_financing_id']);
        $creditFinancing->setEnabled($data['enabled']);
        $links = [];
        foreach ($data['links'] as $link) {
            $link = Link::fromArray($link);
            $links[] = $link;
        }
        $creditFinancing->setLinks($links);

        return $creditFinancing;
    }
}

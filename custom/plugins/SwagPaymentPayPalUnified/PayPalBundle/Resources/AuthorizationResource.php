<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\PayPalBundle\Resources;

use SwagPaymentPayPalUnified\PayPalBundle\RequestType;
use SwagPaymentPayPalUnified\PayPalBundle\RequestUri;
use SwagPaymentPayPalUnified\PayPalBundle\Services\ClientService;
use SwagPaymentPayPalUnified\PayPalBundle\Structs\Payment\Capture;

class AuthorizationResource
{
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function get($id)
    {
        return $this->clientService->sendRequest(RequestType::GET, RequestUri::AUTHORIZATION_RESOURCE . '/' . $id);
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function void($id)
    {
        return $this->clientService->sendRequest(RequestType::POST, RequestUri::AUTHORIZATION_RESOURCE . '/' . $id . '/void');
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function capture($id, Capture $capture)
    {
        $requestData = $capture->toArray();

        return $this->clientService->sendRequest(RequestType::POST, RequestUri::AUTHORIZATION_RESOURCE . '/' . $id . '/capture', $requestData);
    }
}

<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Subscriber\ControllerRegistration;

use Enlight\Event\SubscriberInterface;

class Frontend implements SubscriberInterface
{
    /**
     * @var string
     */
    private $pluginDirectory;

    /**
     * @param string $pluginDirectory
     */
    public function __construct($pluginDirectory)
    {
        $this->pluginDirectory = $pluginDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Frontend_PaypalUnified' => 'onGetUnifiedControllerPath',
            'Enlight_Controller_Dispatcher_ControllerPath_Frontend_PaypalUnifiedInstallments' => 'onGetInstallmentsPaymentControllerPath',
            'Enlight_Controller_Dispatcher_ControllerPath_Frontend_PaypalUnifiedWebhook' => 'onGetWebhookControllerPath',
        ];
    }

    /**
     * Handles the Enlight_Controller_Dispatcher_ControllerPath_Frontend_PaypalUnified event.
     * Returns the path to the frontend controller.
     *
     * @return string
     */
    public function onGetUnifiedControllerPath()
    {
        return $this->pluginDirectory . '/Controllers/Frontend/PaypalUnified.php';
    }

    /**
     * Handles the Enlight_Controller_Dispatcher_ControllerPath_Frontend_PaypalUnifiedInstallments event.
     * Returns the path to the installments controller.
     *
     * @return string
     */
    public function onGetInstallmentsPaymentControllerPath()
    {
        return $this->pluginDirectory . '/Controllers/Frontend/PaypalUnifiedInstallments.php';
    }

    /**
     * Handles the Enlight_Controller_Dispatcher_ControllerPath_Frontend_PaypalUnifiedWebhook event.
     * Returns the path to the webhook controller.
     *
     * @return string
     */
    public function onGetWebhookControllerPath()
    {
        return $this->pluginDirectory . '/Controllers/Frontend/PaypalUnifiedWebhook.php';
    }
}

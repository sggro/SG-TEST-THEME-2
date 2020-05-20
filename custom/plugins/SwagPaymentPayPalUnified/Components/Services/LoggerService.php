<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Components\Services;

use Shopware\Components\Logger;
use SwagPaymentPayPalUnified\PayPalBundle\Components\LoggerServiceInterface;
use SwagPaymentPayPalUnified\PayPalBundle\Components\SettingsServiceInterface;

class LoggerService implements LoggerServiceInterface
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var SettingsServiceInterface
     */
    private $settings;

    public function __construct(Logger $baseLogger, SettingsServiceInterface $settings)
    {
        $this->logger = $baseLogger;
        $this->settings = $settings;
    }

    /**
     * @param string $message
     */
    public function warning($message, array $context = [])
    {
        if (!$this->settings->hasSettings()) {
            return;
        }

        if ((int) $this->settings->get('log_level') === 1) {
            $finalMessage = 'PayPal: ' . $message;
            $this->logger->warning($finalMessage, $context);
        }
    }

    /**
     * @param string $message
     */
    public function notify($message, array $context = [])
    {
        if (!$this->settings->hasSettings()) {
            return;
        }

        if ((int) $this->settings->get('log_level') === 1) {
            $finalMessage = 'PayPal: ' . $message;
            $this->logger->notice($finalMessage, $context);
        }
    }

    /**
     * @param string $message
     */
    public function error($message, array $context = [])
    {
        $finalMessage = 'PayPal: ' . $message;
        $this->logger->error($finalMessage, $context);
    }
}

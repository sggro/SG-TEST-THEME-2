<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Tests\Functional\Subscriber;

use PHPUnit\Framework\TestCase;
use SwagPaymentPayPalUnified\Components\PaymentMethodProvider;
use SwagPaymentPayPalUnified\Subscriber\InContext;
use SwagPaymentPayPalUnified\Tests\Functional\DatabaseTestCaseTrait;
use SwagPaymentPayPalUnified\Tests\Functional\SettingsHelperTrait;
use SwagPaymentPayPalUnified\Tests\Mocks\DummyController;
use SwagPaymentPayPalUnified\Tests\Mocks\ViewMock;

class InContextSubscriberTest extends TestCase
{
    use DatabaseTestCaseTrait;
    use SettingsHelperTrait;

    public function test_construct()
    {
        $subscriber = $this->getSubscriber();

        static::assertNotNull($subscriber);
    }

    public function test_getSubscribedEvents()
    {
        $events = InContext::getSubscribedEvents();

        static::assertCount(2, $events['Enlight_Controller_Action_PostDispatchSecure_Frontend_Checkout']);

        static::assertSame('addInContextButton', $events['Enlight_Controller_Action_PostDispatchSecure_Frontend_Checkout'][0][0]);
        static::assertSame('addInContextInfoToRequest', $events['Enlight_Controller_Action_PostDispatchSecure_Frontend_Checkout'][1][0]);
    }

    public function test_addInContextButton_return_wrong_action()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('foo');

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view, null),
        ]);

        $subscriber = $this->getSubscriber();
        $subscriber->addInContextButton($enlightEventArgs);

        static::assertNull($view->getAssign('paypalUnifiedPaymentId'));
    }

    public function test_addInContextButton_return_unified_inactive()
    {
        $paymentMethodProvider = new PaymentMethodProvider(Shopware()->Container()->get('models'));
        $paymentMethodProvider->setPaymentMethodActiveFlag(false);

        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('confirm');

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view, null),
        ]);

        $this->importSettings();

        $subscriber = $this->getSubscriber();
        $subscriber->addInContextButton($enlightEventArgs);

        static::assertNull($view->getAssign('paypalUnifiedPaymentId'));

        $paymentMethodProvider->setPaymentMethodActiveFlag(true);
    }

    public function test_addInContextButton_return_payment_method_inactive()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('confirm');

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view, null),
        ]);

        $this->importSettings();

        $subscriber = $this->getSubscriber();
        $subscriber->addInContextButton($enlightEventArgs);

        static::assertNull($view->getAssign('paypalUnifiedPaymentId'));
    }

    public function test_addInContextButton_return_not_use_in_context()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('confirm');

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view, null),
        ]);

        $this->importSettings(true);

        $subscriber = $this->getSubscriber();
        $subscriber->addInContextButton($enlightEventArgs);

        static::assertNull($view->getAssign('paypalUnifiedPaymentId'));
    }

    public function test_addInContextButton_return_no_ec_settings()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('confirm');

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view, null),
        ]);

        $this->importSettings(true, true, false, false);

        $subscriber = $this->getSubscriber();
        $subscriber->addInContextButton($enlightEventArgs);

        static::assertNull($view->getAssign('paypalUnifiedPaymentId'));
    }

    public function test_addInContextButton_right_template_assigns()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('confirm');

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view, null),
        ]);

        $this->importSettings(true, true, true);

        $subscriber = $this->getSubscriber();
        $subscriber->addInContextButton($enlightEventArgs);

        static::assertTrue($view->getAssign('paypalUnifiedModeSandbox'));
        static::assertTrue($view->getAssign('paypalUnifiedUseInContext'));
    }

    public function test_addInContextInfoToRequest_returns_because_wrong_action()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('fake');

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
            'request' => $request,
        ]);

        $subscriber = $this->getSubscriber();

        static::assertNull($subscriber->addInContextInfoToRequest($enlightEventArgs));
    }

    public function test_addInContextInfoToRequest_returns_because_wrong_param()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('payment');

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
            'request' => $request,
        ]);

        $subscriber = $this->getSubscriber();

        static::assertNull($subscriber->addInContextInfoToRequest($enlightEventArgs));
    }

    public function test_addInContextInfoToRequest_returns_because_no_redirect()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('payment');
        $request->setParam('useInContext', true);

        $response = new \Enlight_Controller_Response_ResponseTestCase();

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
            'request' => $request,
            'response' => $response,
        ]);

        $subscriber = $this->getSubscriber();

        static::assertNull($subscriber->addInContextInfoToRequest($enlightEventArgs));
    }

    public function test_addInContextInfoToRequest_returns_because_redirect()
    {
        $view = new ViewMock(new \Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setActionName('payment');
        $request->setParam('useInContext', true);

        $response = new \Enlight_Controller_Response_ResponseTestCase();
        $response->setHttpResponseCode(302);

        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view, $response),
            'request' => $request,
            'response' => $response,
        ]);

        $subscriber = $this->getSubscriber();
        $subscriber->addInContextInfoToRequest($enlightEventArgs);

        static::assertSame(302, $response->getHttpResponseCode());
        if (method_exists($this, 'assertStringContainsString')) {
            static::assertStringContainsString(
                '/PaypalUnified/gateway/useInContext/1',
                $response->getHeader('Location')
            );

            return;
        }
        static::assertContains('/PaypalUnified/gateway/useInContext/1', $response->getHeader('Location'));
    }

    /**
     * @param bool $active
     * @param bool $useInContext
     * @param bool $sandboxMode
     * @param bool $hasEcSettings
     */
    private function importSettings($active = false, $useInContext = false, $sandboxMode = false, $hasEcSettings = true)
    {
        $this->insertGeneralSettingsFromArray([
            'shopId' => 1,
            'active' => $active,
            'sandbox' => $sandboxMode,
            'useInContext' => $useInContext,
            'clientId' => 'test',
            'clientSecret' => 'test',
        ]);

        if ($hasEcSettings) {
            $this->insertExpressCheckoutSettingsFromArray([]);
        }
    }

    /**
     * @return InContext
     */
    private function getSubscriber()
    {
        return new InContext(
            Shopware()->Container()->get('dbal_connection'),
            Shopware()->Container()->get('paypal_unified.settings_service'),
            Shopware()->Container()->get('paypal_unified.dependency_provider')
        );
    }
}

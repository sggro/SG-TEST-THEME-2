<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Tests\Functional\Subscriber;

use Enlight_Template_Manager;
use PHPUnit\Framework\TestCase;
use SwagPaymentPayPalUnified\Components\PaymentMethodProvider;
use SwagPaymentPayPalUnified\Subscriber\InstallmentsBanner;
use SwagPaymentPayPalUnified\Tests\Functional\DatabaseTestCaseTrait;
use SwagPaymentPayPalUnified\Tests\Functional\SettingsHelperTrait;
use SwagPaymentPayPalUnified\Tests\Mocks\DummyController;
use SwagPaymentPayPalUnified\Tests\Mocks\ViewMock;

class InstallmentsBannerSubscriberTest extends TestCase
{
    use DatabaseTestCaseTrait;
    use SettingsHelperTrait;

    const CLIENT_ID = 'testClientId';

    public function test_can_be_created()
    {
        $subscriber = $this->getSubscriber();
        static::assertNotNull($subscriber);
    }

    public function test_getSubscribedEvents_has_correct_events()
    {
        $events = InstallmentsBanner::getSubscribedEvents();
        static::assertCount(2, $events);
        static::assertSame('onPostDispatchSecure', $events['Enlight_Controller_Action_PostDispatchSecure_Frontend']);
        static::assertSame('onPostDispatchSecure', $events['Enlight_Controller_Action_PostDispatchSecure_Widgets']);
    }

    public function test_onPostDistpatchSecure_without_any_setttings()
    {
        $subscriber = $this->getSubscriber();

        $view = new ViewMock(new Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
        ]);

        $result = $subscriber->onPostDispatchSecure($enlightEventArgs);

        static::assertNull($result);
        static::assertNull($view->getAssign('paypalUnifiedInstallmentsBanner'));
    }

    public function test_onPostDispatchSecure_return_setting_inactive()
    {
        $subscriber = $this->getSubscriber();
        $this->createTestSettings(false);

        $view = new ViewMock(new Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
        ]);

        $subscriber->onPostDispatchSecure($enlightEventArgs);

        static::assertNull($view->getAssign('paypalUnifiedInstallmentsBanner'));
    }

    public function test_onPostDispatchSecure_payment_method_inactive()
    {
        $paymentMethodProvider = new PaymentMethodProvider(Shopware()->Container()->get('models'));
        $paymentMethodProvider->setPaymentMethodActiveFlag(false);
        $subscriber = $this->getSubscriber();
        $this->createTestSettings();

        $view = new ViewMock(new Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
        ]);

        $subscriber->onPostDispatchSecure($enlightEventArgs);

        static::assertNull($view->getAssign('paypalUnifiedInstallmentsBanner'));
    }

    public function test_onPostDispatchSecure_installments_banner_inactive()
    {
        $paymentMethodProvider = new PaymentMethodProvider(Shopware()->Container()->get('models'));
        $paymentMethodProvider->setPaymentMethodActiveFlag(false);
        $subscriber = $this->getSubscriber();
        $this->createTestSettings(true, false);

        $view = new ViewMock(new Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
        ]);

        $subscriber->onPostDispatchSecure($enlightEventArgs);

        static::assertNull($view->getAssign('paypalUnifiedInstallmentsBanner'));
    }

    public function test_onPostDispatchSecure_assigns_variables_to_view()
    {
        $subscriber = $this->getSubscriber();
        $this->createTestSettings();

        $view = new ViewMock(new Enlight_Template_Manager());
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setControllerName('foo');
        $request->setActionName('bar');
        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
            'request' => $request,
        ]);

        $subscriber->onPostDispatchSecure($enlightEventArgs);

        static::assertTrue((bool) $view->getAssign('paypalUnifiedInstallmentsBanner'));
        static::assertSame(self::CLIENT_ID, $view->getAssign('paypalUnifiedInstallmentsBannerClientId'));
        static::assertSame(0.0, $view->getAssign('paypalUnifiedInstallmentsBannerAmount'));
        static::assertSame('EUR', $view->getAssign('paypalUnifiedInstallmentsBannerCurrency'));
    }

    public function test_onPostDispatchSecure_assigns_variables_to_view_product_detail_page()
    {
        $subscriber = $this->getSubscriber();
        $this->createTestSettings();
        $productAmount = 19.99;

        $view = new ViewMock(new Enlight_Template_Manager());
        $view->assign('sArticle', ['price_numeric' => $productAmount]);
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setControllerName('detail');
        $request->setActionName('index');
        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
            'request' => $request,
        ]);

        $subscriber->onPostDispatchSecure($enlightEventArgs);

        static::assertTrue((bool) $view->getAssign('paypalUnifiedInstallmentsBanner'));
        static::assertSame(self::CLIENT_ID, $view->getAssign('paypalUnifiedInstallmentsBannerClientId'));
        static::assertSame($productAmount, $view->getAssign('paypalUnifiedInstallmentsBannerAmount'));
        static::assertSame('EUR', $view->getAssign('paypalUnifiedInstallmentsBannerCurrency'));
    }

    public function test_onPostDispatchSecure_assigns_variables_to_view_cart_page()
    {
        $subscriber = $this->getSubscriber();
        $this->createTestSettings();
        $cartAmount = 19.99;

        $view = new ViewMock(new Enlight_Template_Manager());
        $view->assign('sBasket', ['AmountNumeric' => $cartAmount]);
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setControllerName('checkout');
        $request->setActionName('cart');
        $enlightEventArgs = new \Enlight_Controller_ActionEventArgs([
            'subject' => new DummyController($request, $view),
            'request' => $request,
        ]);

        $subscriber->onPostDispatchSecure($enlightEventArgs);

        static::assertTrue((bool) $view->getAssign('paypalUnifiedInstallmentsBanner'));
        static::assertSame(self::CLIENT_ID, $view->getAssign('paypalUnifiedInstallmentsBannerClientId'));
        static::assertSame($cartAmount, $view->getAssign('paypalUnifiedInstallmentsBannerAmount'));
        static::assertSame('EUR', $view->getAssign('paypalUnifiedInstallmentsBannerCurrency'));
    }

    /**
     * @return InstallmentsBanner
     */
    private function getSubscriber()
    {
        return new InstallmentsBanner(
            Shopware()->Container()->get('paypal_unified.settings_service'),
            Shopware()->Container()->get('dbal_connection'),
            Shopware()->Container()->get('shopware_storefront.context_service')
        );
    }

    /**
     * @param bool $active
     */
    private function createTestSettings($active = true, $advertiseInstallments = true)
    {
        $this->insertGeneralSettingsFromArray([
            'shopId' => 1,
            'clientId' => self::CLIENT_ID,
            'active' => $active,
            'advertiseInstallments' => $advertiseInstallments,
        ]);
    }
}

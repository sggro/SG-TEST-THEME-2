<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Tests\Functional\Subscriber\Documents\Mock;

class HookArgsWithCorrectPaymentId extends \Enlight_Hook_HookArgs
{
    /**
     * @var \Smarty_Data
     */
    private $_view;

    /**
     * @var \Enlight_Template_Manager
     */
    private $_template;

    /**
     * @param bool $isShopware55
     */
    public function __construct($isShopware55 = false)
    {
        if ($isShopware55) {
            parent::__construct(new \stdClass(), '');
        }
    }

    /**
     * @return \Enlight_Class
     */
    public function getSubject()
    {
        $subject = \Enlight_Class::Instance(\Shopware_Components_Document::class);

        $subject->_order = new \Shopware_Models_Document_Order(15);
        $view = new \Smarty_Data();
        $view->assign('Order', [
            '_payment' => [
                'description' => 'PayPal',
            ],
        ]);
        $subject->_view = $view;
        $subject->_template = new \Enlight_Template_Manager();

        $this->_view = $subject->_view;
        $this->_template = $subject->_template;

        return $subject;
    }

    /**
     * @return \Smarty_Data
     */
    public function getView()
    {
        return $this->_view;
    }

    /**
     * @return \Enlight_Template_Manager
     */
    public function getTemplate()
    {
        return $this->_template;
    }
}

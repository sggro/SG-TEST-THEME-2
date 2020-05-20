<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPaymentPayPalUnified\Tests\Functional\Bundle\AccountBundle\Service\Validator;

use PHPUnit\Framework\TestCase;
use Shopware\Bundle\AccountBundle\Service\Validator\AddressValidatorInterface as AddressValInterface;
use Shopware\Components\Api\Exception\ValidationException;
use Shopware\Models\Customer\Address;
use SwagPaymentPayPalUnified\Bundle\AccountBundle\Service\Validator\AddressValidatorDecorator as AddressDecorator;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class AddressValidatorDecoratorTest extends TestCase
{
    public function test_construct()
    {
        $validator = new AddressDecorator(new AddressValidatorMock(), Shopware()->Container()->get('front'));
        static::assertNotNull($validator);
    }

    public function test_isValid_inner_validator()
    {
        $validator = new AddressDecorator(new AddressValidatorMock(), Shopware()->Container()->get('front'));
        static::assertTrue($validator->isValid(new Address()));
    }

    public function test_validate_return_without_request()
    {
        $front = new FrontMock();

        $validator = new AddressDecorator(new AddressValidatorMock(), $front);
        static::assertNull($validator->validate(new Address()));
    }

    public function test_validate_return_with_wrong_controller_name()
    {
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setControllerName('fake');
        $front = new FrontMock();
        $front->setRequest($request);

        $validator = new AddressDecorator(new AddressValidatorMock(), $front);
        static::assertNull($validator->validate(new Address()));
    }

    public function test_validate_throw_validation_exception_country()
    {
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setControllerName('PaypalUnifiedExpressCheckout');
        $front = new FrontMock();
        $front->setRequest($request);

        $validator = new AddressDecorator(new AddressValidatorWithStateException(), $front);

        $this->expectException(ValidationException::class);
        $validator->validate(new Address());
    }

    public function test_validate_throw_no_validation_exception()
    {
        $request = new \Enlight_Controller_Request_RequestTestCase();
        $request->setControllerName('PaypalUnifiedExpressCheckout');
        $front = new FrontMock();
        $front->setRequest($request);

        $validator = new AddressDecorator(new AddressValidatorMock(), $front);

        static::assertNull($validator->validate(new Address()));
    }
}

class AddressValidatorMock implements AddressValInterface
{
    public function validate(Address $address)
    {
    }

    /**
     * @return bool
     */
    public function isValid(Address $address)
    {
        return true;
    }
}

class AddressValidatorWithStateException implements AddressValInterface
{
    /**
     * @throws ValidationException
     */
    public function validate(Address $address)
    {
        $violations = new ConstraintViolationList();
        $violations->add(new ConstraintViolation('State invalid.', '', [], '', '', 'state'));

        throw new ValidationException($violations);
    }

    /**
     * @return bool
     */
    public function isValid(Address $address)
    {
        return true;
    }
}

class FrontMock extends \Enlight_Controller_Front
{
    /**
     * @var \Enlight_Controller_Request_RequestTestCase
     */
    protected $request;

    public function __construct()
    {
    }

    /**
     * @param \Enlight_Controller_Request_RequestTestCase $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}

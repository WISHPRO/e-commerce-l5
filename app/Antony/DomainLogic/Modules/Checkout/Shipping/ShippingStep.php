<?php namespace app\Antony\DomainLogic\Modules\Checkout\Shipping;

use app\Antony\DomainLogic\Contracts\Checkout\ShippingDataContract;
use app\Antony\DomainLogic\Modules\Checkout\Base\AppCheckout;

class ShippingStep extends AppCheckout implements ShippingDataContract
{

    /**
     * Handle a redirect after a CRUD operation
     *
     * @param $request
     *
     * @return mixed
     */
    public function handleRedirect($request)
    {
        // TODO: Implement handleRedirect() method.
    }

    public function processShippingDetails($data)
    {
        // TODO: Implement processShippingDetails() method.
    }

    /**
     * @return mixed
     */
    public function getCookieData()
    {
        // TODO: Implement getCookieData() method.
    }

    /**
     * @return mixed
     */
    public function verifyCurrentStep()
    {
        // TODO: Implement verifyCurrentStep() method.
    }
}
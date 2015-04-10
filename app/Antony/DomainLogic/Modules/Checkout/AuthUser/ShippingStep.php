<?php namespace app\Antony\DomainLogic\Modules\Checkout\AuthUser;

use app\Antony\DomainLogic\Contracts\Checkout\ShippingDataContract;
use app\Antony\DomainLogic\Modules\Checkout\Base\AppCheckout;

class ShippingStep extends AppCheckout implements ShippingDataContract
{

    /**
     * Gets the data from a cookie
     *
     * @return mixed
     */
    public function getCookieData()
    {
        // TODO: Implement getCookieData() method.
    }

    /**
     * Verifies the current step in the checkout process
     *
     * @return mixed
     */
    public function verifyCurrentStep()
    {
        // TODO: Implement verifyCurrentStep() method.
    }

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
}
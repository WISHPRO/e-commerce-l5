<?php namespace app\Antony\DomainLogic\Modules\Checkout\Payment;

use app\Antony\DomainLogic\Contracts\Checkout\PaymentDetailsContract;
use app\Antony\DomainLogic\Modules\Checkout\Base\AppCheckout;

class CheckoutPaymentStep extends AppCheckout implements PaymentDetailsContract
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

    public function processPaymentDetails($data)
    {
        // TODO: Implement processPaymentDetails() method.
    }
}
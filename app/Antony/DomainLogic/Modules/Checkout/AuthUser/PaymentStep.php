<?php namespace app\Antony\DomainLogic\Modules\Checkout\AuthUser;

use app\Antony\DomainLogic\Modules\Checkout\Base\AuthUserCheckout;

class PaymentStep extends AuthUserCheckout
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

    /**
     * process the current step in the checkout process
     *
     * @param $data
     *
     * @return mixed
     */
    public function processCurrentStep($data)
    {
        // TODO: Implement processCurrentStep() method.
    }
}
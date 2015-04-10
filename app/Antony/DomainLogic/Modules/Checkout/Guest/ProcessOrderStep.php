<?php namespace app\Antony\DomainLogic\Modules\Checkout\Guest;

use app\Antony\DomainLogic\Contracts\Checkout\ProcessOrderContract;
use app\Antony\DomainLogic\Modules\Checkout\Base\AppCheckout;

class ProcessOrderStep extends AppCheckout implements ProcessOrderContract
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

    public function processOrder($data)
    {
        // TODO: Implement processOrder() method.
    }
}
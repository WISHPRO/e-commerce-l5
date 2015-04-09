<?php namespace app\Antony\DomainLogic\Modules\Checkout\Base;

use app\Antony\DomainLogic\Contracts\Database\DataActionResult;
use app\Antony\DomainLogic\Contracts\Redirects\AppRedirector;

abstract class AppCheckout implements DataActionResult, AppRedirector
{
    /**
     * @var string
     */
    protected $stepStatus;

    /**
     * Gets the data from a cookie
     *
     * @return mixed
     */
    abstract public function getCookieData();

    /**
     * Verifies the current step in the checkout process
     *
     * @return mixed
     */
    abstract public function verifyCurrentStep();

    /**
     * @return mixed
     */
    public function getStepStatus()
    {
        return $this->stepStatus;
    }

    /**
     * @param mixed $stepStatus
     */
    public function setStepStatus($stepStatus)
    {
        $this->stepStatus = $stepStatus;
    }
}
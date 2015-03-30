<?php namespace App\Antony\DomainLogic\Modules\Checkout;

use App\Antony\DomainLogic\Modules\Cookies\ApplicationCookie as CheckoutCookie;

interface checkoutProgress
{

    public function getCurrentStep();

    public function getStepState();

    public function getStepData();

    public function redirect();
}

class CheckOutSteps implements checkoutProgress
{
    const STEP_1 = 1;

    const STEP_2 = 2;

    const STEP_3 = 3;

    const STEP_4 = 4;

    const STATE_DONE = 'completed';

    const STATE_ACTIVE = 'active';

    const ROUTE_1 = 'checkout.step1';

    const ROUTE_2 = 'checkout.step2';

    const ROUTE_3 = 'checkout.step3';

    const ROUTE_4 = 'checkout.step4';

    public $currentStep;

    public $stepState;

    public $data;

    public $stepAttribute = 'step';

    public $stateAttribute = 'state';

    public $dataAttribute = 'data';

    protected $cookie;

    /**
     * @param CheckoutCookie $cookieRepositoryInterface
     */
    public function __construct(CheckoutCookie $cookieRepositoryInterface)
    {

        $this->cookie = $cookieRepositoryInterface;

        $this->data = $this->cookie->fetch()->get();

        $this->getCurrentStep();

        $this->getStepState();
    }

    /**
     * @return mixed
     */
    public function getCurrentStep()
    {

        $this->currentStep = array_get($this->data, $this->stepAttribute);

        return $this->currentStep;
    }

    /**
     * @return mixed|string
     */
    public function getStepState()
    {

        $this->stateAttribute = array_get($this->data, $this->stateAttribute);

        return $this->stateAttribute;
    }

    /**
     * @return array|null
     */
    public function getStepData()
    {

        return $this->data;
    }

    public function redirect()
    {

        switch ($this->currentStep) {
            case self::STEP_1: {
                // step 1
                if ($this->stepState === self::STATE_DONE) {

                    // redirect to step 2

                    return redirect()->route(self::ROUTE_2);
                } else {
                    // just redirect to their previous step
                    return redirect()->route(self::ROUTE_1)->with($this->dataAttribute, $this->data);
                }


            }
                break;
            case self::STEP_2: {
                // step 2
                if ($this->stepState === self::STATE_DONE) {
                    // redirect to step 2
                    return redirect()->route(self::ROUTE_3);
                }

                return redirect()->route(self::ROUTE_2)->with($this->dataAttribute, $this->data);
            }
                break;
            default: {
                // The user was nowhere close to getting done
                return redirect()->route('checkout.step1');
            }

        }
    }

}
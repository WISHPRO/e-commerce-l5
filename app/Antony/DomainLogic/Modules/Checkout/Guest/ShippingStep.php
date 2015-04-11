<?php namespace app\Antony\DomainLogic\Modules\Checkout\Guest;

use app\Antony\DomainLogic\Modules\Checkout\Base\GuestCheckout;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ShippingStep extends GuestCheckout
{
    /**
     * Step identifier
     *
     * @var int
     */
    const STEP_ID = 2;

    /**
     * @param $data
     *
     * @return $this
     */
    public function processCurrentStep($data)
    {
        $result = $this->guestRepository->update($data, $this->cookieData->id);

        if (!$result) {

            $this->setStepStatus(static::STEP_INCOMPLETE);

            return $this;
        }

        $this->setStepStatus(static::STEP_COMPLETE);

        return $this;
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
        if (!$request instanceof Request) {

            throw new InvalidArgumentException('Please provide a request class to this method');
        }

        if (is_null($this->getStepStatus())) {

            return redirect()->route('checkout.auth');
        }
        switch ($this->getStepStatus()) {

            case (static::STEP_ALREADY_DONE) : {

                // redirect with data
                return redirect()->back()->withInput($this->cookieData);
            }
            case (static::STEP_INCOMPLETE) : {

                return redirect()->route('checkout.step2');
            }
            case (static::STEP_COMPLETE) : {

                // redirect user to the next step
                return redirect()->route('checkout.step3');
            }
        }
        return redirect()->route('checkout.auth');
    }
}
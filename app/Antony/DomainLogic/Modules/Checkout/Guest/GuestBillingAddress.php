<?php namespace app\Antony\DomainLogic\Modules\Checkout\Guest;

use app\Antony\DomainLogic\Contracts\Checkout\Guest\GuestCheckoutContract;
use app\Antony\DomainLogic\Modules\Checkout\Base\GuestCheckout;
use App\Models\Guest;
use Illuminate\Http\Request;
use InvalidArgumentException;

class GuestBillingAddress extends GuestCheckout implements GuestCheckoutContract
{
    /**
     * Step identifier
     *
     * @var int
     */
    const STEP_ID = 1;

    /**
     * @return \Illuminate\View\View
     */
    public function displayGuestForm()
    {
        return view('frontend.Checkout.guest');
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function processCurrentStep($data)
    {
        if (empty($this->getCookieData())) {

            // this step has not yet been initialized, so we create the guest user
            $this->guest = $this->guestRepository->add($data);

            if ($this->guest !== null) {

                $this->createGuestCheckoutCookie(static::STEP_ID, $this->guest);

                $this->setStepStatus(static::STEP_COMPLETE);

                return $this;
            } else {

                // fail
                $this->setStepStatus(static::STEP_INCOMPLETE);

                return $this;
            }
        }

        $this->guest = $this->cookieData;

        $this->setStepStatus(static::STEP_ALREADY_DONE);

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

            case (static::STEP_COMPLETE) : {

                // redirect with data
                return redirect()->back()->withInput($this->cookieData);
            }
            case (static::STEP_INCOMPLETE) : {

                return redirect()->route('checkout.step1');
            }
            case (static::STEP_ALREADY_DONE) : {

                // redirect user to the next step
                return redirect()->route('checkout.step2');
            }
        }
        return redirect()->route('checkout.auth');
    }
}
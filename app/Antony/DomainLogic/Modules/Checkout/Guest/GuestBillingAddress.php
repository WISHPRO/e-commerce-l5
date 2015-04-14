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
     * Route to previous step
     *
     * @var null
     */
    protected $previousRoute = null;

    /**
     * Route to next step
     *
     * @var string
     */
    protected $nextStepRoute = 'checkout.step2';

    /**
     * @return \Illuminate\View\View
     */
    public function displayGuestForm()
    {
        $state = $this->getCookieData('step');

        if (!is_null($state)) {
            if ($this->getCookieData() instanceof Guest) {

                return view('frontend.Checkout.guest')->with('guest', $this->cookieData);
            }
            return view('frontend.Checkout.guest');

        }
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
            $this->guest = $this->guestRepository->addGuest($data, null);

            if ($this->guest !== null) {

                $this->setStepStatus(static::STEP_COMPLETE);

                $this->createGuestCheckoutCookie(static::STEP_ID, $this->guest);

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

            return redirect()->route($this->defaultRoute);
        }
        switch ($this->getStepStatus()) {

            case (static::STEP_COMPLETE) : {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Your details were successfully added', 'target' => link_to_route($this->nextStepRoute)]);
                } else {
                    flash('Your details were successfully added');
                    // redirect with data
                    return redirect()->route($this->nextStepRoute);
                }
            }
            case (static::STEP_INCOMPLETE) : {

                if ($request->ajax()) {
                    return response()->json(['message' => 'An error occurred when adding your details. Please try again'], 422);
                } else {
                    flash()->error('An error occurred when adding your details. Please try again');
                    return redirect()->back()->withInput($this->cookieData);
                }
            }
            case (static::STEP_ALREADY_DONE) : {

                // user already did this step, so we redirect them back
                return redirect()->route($this->nextStepRoute);
            }
        }
        return redirect()->route($this->defaultRoute);
    }
}
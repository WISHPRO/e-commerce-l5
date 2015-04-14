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
     * Route to previous step
     *
     * @var null
     */
    protected $previousRoute = 'checkout.step1';

    /**
     * Route to next step
     *
     * @var string
     */
    protected $nextStepRoute = 'checkout.step3';

    /**
     * @param $data
     *
     * @return $this
     */
    public function processCurrentStep($data)
    {
        $this->getCookieData();

        $result = $this->guestRepository->update($data, $this->cookieData->id);

        if (!$result) {

            $this->setStepStatus(static::STEP_INCOMPLETE);

            $this->updateGuestCookie(static::STEP_ID, $this->guestRepository->find($this->cookieData->id));

            return $this;
        }

        $this->setStepStatus(static::STEP_COMPLETE);

        $this->updateGuestCookie(static::STEP_ID, $this->guestRepository->find($this->cookieData->id));

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

            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        switch ($this->getStepStatus()) {

            case (static::STEP_COMPLETE): {

                if ($request->ajax()) {
                    return response()->json(['message' => 'You Successfully edited your shipping details', 'target' => route($this->nextStepRoute)]);
                } else {
                    flash('You Successfully edited your shipping details');
                    return redirect()->back();
                }

            }
            case (static::STEP_INCOMPLETE): {

                if ($request->ajax()) {
                    return response()->json(['message' => 'An error occurred. Please try again', 'target' => route($this->nextStepRoute)]);
                }
                flash()->error('An error occurred. Please try again');

                return redirect()->back()->withInput($request->all());
            }
            default: {

                return redirect()->back();
            }
        }
    }
}
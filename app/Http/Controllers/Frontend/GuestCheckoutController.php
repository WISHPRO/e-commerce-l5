<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Checkout\Guest\GuestBillingAddress;
use app\Antony\DomainLogic\Modules\Checkout\Guest\ShippingStep;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Checkout\GuestCheckoutRequest;
use Illuminate\Http\Response;

class GuestCheckoutController extends Controller
{

    /**
     * @var GuestBillingAddress
     */
    private $guest;

    /**
     * @var ShippingStep
     */
    private $shippingStep;

    /**
     * @param GuestBillingAddress $guestBegin
     */
    public function __construct(GuestBillingAddress $guestBegin, ShippingStep $shippingStep)
    {

        $this->guest = $guestBegin;
        $this->shippingStep = $shippingStep;
    }

    /**
     * checkout authentication
     *
     * @return Response
     */
    public function auth()
    {
        return view('frontend.Checkout.auth');
    }

    /**
     * Step 1 of 4
     *
     * Allow guest users to submit their personal info
     *
     * @return Response
     */
    public function guestInfo()
    {
        return $this->guest->displayGuestForm();
    }


    /**
     * @param GuestCheckoutRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postGuestInfo(GuestCheckoutRequest $request)
    {
        return $this->guest->processCurrentStep($request->all())->handleRedirect($request);
    }

    /**
     * Step 2 of 4
     *
     * Allow users and guests to view and edit their shipping information
     *
     * @return Response
     */
    public function shipping()
    {
        // fetch the guest user
        $guest = $this->guest->retrieveGuestDetails();

        return view('frontend.Checkout.shipping', compact('guest'));
    }

    /**
     * @param GuestCheckoutRequest $request
     *
     * @return mixed
     */
    public function editShippingAddress(GuestCheckoutRequest $request)
    {
        return $this->shippingStep->processCurrentStep($request->all())->handleRedirect($request);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function payment()
    {
        return view('frontend.Checkout.payment');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function reviewOrder()
    {

        return view('frontend.Checkout.reviewOrder');
    }
}

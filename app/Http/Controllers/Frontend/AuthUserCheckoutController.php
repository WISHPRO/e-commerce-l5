<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Checkout\AuthUser\ShippingStep;
use App\Http\Controllers\Controller;
use App\Http\Request\Accounts\updateShippingInfo;
use App\Http\Requests;
use App\Models\Guest;

class AuthUserCheckoutController extends Controller
{
    /**
     * @var ShippingStep
     */
    private $shippingStep;

    /**
     * @param ShippingStep $shippingStep
     */
    public function __construct(ShippingStep $shippingStep)
    {

        $this->shippingStep = $shippingStep;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = $this->shippingStep->retrieveUserDetails();

        return view('frontend.Checkout.shipping', compact('user'));
    }

    /**
     * @param updateShippingInfo $request
     *
     * @return mixed
     */
    public function shipping(updateShippingInfo $request)
    {
        return $this->shippingStep->processCurrentStep($request->all())->handleRedirect($request);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment()
    {
        return view('frontend.Checkout.payment');
    }

    public function postPayment()
    {
        // process user payment details
    }

    /**
     * @return \Illuminate\View\View
     */
    public function reviewOrder()
    {

        return view('frontend.Checkout.reviewOrder');
    }
}

<?php namespace app\Http\Controllers\Frontend;

use app\Anto\domainLogic\contracts\CookieRepositoryInterface;
use app\Anto\DomainLogic\repositories\Guest\GuestRepository;
use app\Anto\DomainLogic\repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\GuestCheckoutRequest;
use CheckoutCookie;
use Illuminate\Contracts\Auth\Guard;
use Response;

class CheckoutController extends Controller
{

    // step Identifier. numbers range from 1 to 4, depending on the checkout method
    protected $stepID = null;

    // state of a user's progress in the checkout
    protected $stepState = "active";

    protected $guest;

    protected $user;

    protected $auth;

    protected $cookie = null;

    /**
     * @param GuestRepository $guestRepository
     * @param UserRepository $userRepository
     * @param Guard $guard
     * @param CookieRepositoryInterface $checkoutCookie
     */
    public function __construct(GuestRepository $guestRepository, UserRepository $userRepository, Guard $guard, CookieRepositoryInterface $checkoutCookie)
    {
        $this->guest = $guestRepository;

        $this->user = $userRepository;

        $this->auth = $guard;

        $this->cookie = $checkoutCookie;
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
        $this->stepID = 1;

        if (!$this->auth->check()) {
            return view('frontend.Checkout.guest');

        } else {
            // skip step 1. return a view that will allow the user to modify their shipping info
            return redirect()->route('checkout.step2');
        }
    }

    /**
     * Saving guest Information
     *
     * @param \App\Http\Requests\GuestCheckoutRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postGuestInfo(GuestCheckoutRequest $request)
    {
        $this->stepID = 1;

        $guest = $this->guest->addIfNotExist($this->cookie->fetch()->get('id'), $request->except('_token', 'guest'));

        if (empty($guest)) {
            flash()->error('Form submission failed. Please try again');

            return redirect()->back();
        }

        flash()->success('Action was a success');

        $this->stepState = 'complete';

        // make the cookie that will determine the user's state in the checkout progress
        $progressCookie = $this->cookie->create(
            [
                'step' => $this->stepID,
                'state' => $this->stepState,
                'progressData' => $guest
            ]
        );

        // create the cookie that identifies a user as a guest
        $guestCookie = $this->cookie->create($guest);

        // redirect the user to the next step
        return redirect()->route('checkout.step2')->withCookies(
            [$guestCookie, $progressCookie]
        );
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
        $this->stepID = 2;

        if (!$this->cookie->exists()) {
            return redirect()->route('checkout.auth');
        }

        $guestInfo = $this->cookie->fetch();

        return view('frontend.Checkout.shipping', compact('guestInfo'));
    }

    /**
     * Allow guest users to edit their shipping information in place. Still step 2
     *
     * @param                                         $id
     * @param \App\Http\Requests\GuestCheckoutRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editShippingAddress($id, GuestCheckoutRequest $request)
    {
        if ($this->auth->check()) {

            // user is not a guest

        }

        $guest = $this->cookie->fetch();

        if (empty($guest)) {
            return redirect()->route('checkout.auth');
        }

        if ($guest->update($request->except('_token', 'guest'))) {
            flash('Information was successfully updated');

            return redirect()->back();
        }
        flash()->error('An error occured. Please try again later');

        return redirect()->back();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function payment()
    {
        $this->stepID = 3;

        return view('frontend.Checkout.payment');
    }

    public function modifyPaymentInfo()
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function determineUserProgress()
    {
        $cookieData = $this->cookie->fetch();

        if (empty($cookieData)) {
            // The user was nowhere close to getting done
            return redirect()->route('checkout.step1');
        }
        // grab the step pos
        $step = array_get($cookieData, 'step');

        $state = array_get($cookieData, 'state');

        $data_state = array_get($cookieData, 'progressData');

        // okay. The logic is that, we grab data from the checkout cookie, and use the data to determine the user's progress in checking out
        // The states are set in the checkout controller actions
        // so, if a user had completed a step, we redirect them to the next step
        // otherwise, we redirect them back to the step they were

        switch ($step) {
            case 1: {
                // step 1
                if ($state == 'complete') {
                    // redirect to step 2
                    return redirect()->route('checkout.step2')->with('data', $data_state);
                }

                return redirect()->route('checkout.step1');
            }
                break;
            case 2: {
                // step 2
                if ($state == 'complete') {
                    // redirect to step 2
                    return redirect()->route('checkout.step3')->with('data', $data_state);
                }

                return redirect()->route('checkout.step2')->with('data', $data_state);
            }
                break;
            case 3: {
                // step 3
                if ($state == 'complete') {
                    // redirect to step 4
                    return redirect()->route('checkout.step4');
                }

                return redirect()->route('checkout.step3');
            }
                break;
            case 4: {
                // step 4
                if ($state == 'complete') {
                    // the user had just completed the checkout process.
                    return redirect()->route('checkout.step4');
                }

                return redirect()->route('checkout.step3');
            }
                break;
            default: {
                // The user was nowhere close to getting done
                return redirect()->route('checkout.step1');
            }

        }
    }
}

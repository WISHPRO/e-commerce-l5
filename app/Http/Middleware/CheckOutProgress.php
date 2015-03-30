<?php namespace App\Http\Middleware;

use App\Antony\DomainLogic\modules\Cookies\CheckoutCookie;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckOutProgress
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    protected $cookie;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth, CheckoutCookie $checkoutCookie)
    {
        $this->auth = $auth;

        $this->cookie = $checkoutCookie;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // determine the users state during the checkout and redirect them accordingly, until they complete the checkout

        // if no cookie matching our needs exists, we just redirect to the checkout auth page
        if (!$this->cookie->exists()) {

            return redirect()->route('checkout.auth');
        }

        $data = $this->cookie->fetch()->get();

        // check if its the first time to checkout. In this case the query string will exist
        if ($request->get('guest') == 1 and empty($data)) {

            return $next($request);
        }

        // unless the user has completed the checkout, then we shall keep redirecting them to their appropriate step
        if (array_get($data, 'state') !== 'order_submitted') {

            // return redirect()->route('checkout.step2');

            return $this->determineUserProgress();
        } else {
            // this implies that the user has completed the checkout process
            return $next($request);
        }

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function determineUserProgress()
    {
        $cookieData = $this->cookie->fetch()->get();

        if (empty($cookieData)) {
            // The user was nowhere close to getting done
            return redirect()->route('checkout.step1');
        }
        // grab the step pos
        $step = array_get($cookieData, 'step');

        // get the state of their progress
        $state = array_get($cookieData, 'state');

        // get the data
        $progressData = array_get($cookieData, 'progressData');

        // okay. The logic is that, we grab data from the checkout cookie, and use the data to determine the user's progress in checking out
        // The states are set in the checkout controller actions
        // so, if a user had completed a step, we redirect them to the next step
        // otherwise, we redirect them back to the step they were

        switch ($step) {
            case 1: {
                // step 1
                if ($state === 'complete') {

                    // redirect to step 2

                    return view('frontend.Checkout.shipping', compact('progressData'));
                } else {
                    // just redirect to their previous step
                    return view('frontend.Checkout.guest', compact('ProgressData'));
                }


            }
                break;
            case 2: {
                // step 2
                if ($state === 'complete') {
                    // redirect to step 2
                    return redirect()->route('checkout.step3');
                }

                return redirect()->route('checkout.step2')->with('data', $progressData);
            }
                break;
            case 3: {
                // step 3
                if ($state === 'complete') {
                    // redirect to step 4
                    return redirect()->route('checkout.step4');
                }

                return redirect()->route('checkout.step3')->with('data', $progressData);
            }
                break;
            case 4: {
                // step 4
                if ($state == 'complete') {
                    // the user had just completed the checkout process.
                    return redirect()->route('checkout.step4');
                }

                return redirect()->route('checkout.step3')->with('data', $progressData);
            }
                break;
            default: {
                // The user was nowhere close to getting done
                return redirect()->route('checkout.step1');
            }

        }
    }

}

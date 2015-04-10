<?php namespace App\Http\Middleware;

use App\Antony\DomainLogic\modules\Cookies\CheckoutCookie;
use App\Models\Guest;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckoutAuthentication
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The checkout cookie
     *
     * @var CheckoutCookie
     */
    protected $cookie;

    /**
     * @param Guard $auth
     * @param CheckoutCookie $checkoutCookie
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
        $data = $this->cookie->fetch()->get();

        // open the door for guests to checkout, if the data stored in the progressData key is an instance of the Guest model
        if (array_get($data, 'data') instanceof Guest) {

            return $next($request);
        }

        // for the initial step, the checkout cookie won't be present. so we check for the query string
        if ($request->get('guest') == 1 and empty($data)) {
            return $next($request);
        }

        // a registered user should authenticate before checking out
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {

                return redirect()->guest('checkout/auth');
            }
        }

        return $next($request);
    }

}

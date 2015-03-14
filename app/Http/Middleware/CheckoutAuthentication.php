<?php namespace App\Http\Middleware;

use app\Anto\DomainLogic\repositories\Cookies\CheckoutCookie;
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
        $guestID = $this->cookie->fetch()->get('id');

        // open the door for guests to checkout, if the guest cookie is present
        if (!empty($guestID)) {
            return $next($request);
        }

        // open the door for guests to checkout, if the cookie isn't present and there's a query string 'guest' key
        if ($request->get('guest') == 1 and empty($guestID)) {
            return $next($request);
        }

        // normal auth
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

<?php namespace App\Http\Middleware;

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
     * @param Guard $auth
     */
    public function __construct( Guard $auth )
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        $guestID = \Cookie::get( 'g_c' );
        // open the door for guests to checkout, if the guest cookie is present
        if ( ! empty( $guestID )) {
            return $next( $request );
        }
        // open the door for guests to checkout, if the cookie isn't present and there's a query string 'guest' key
        if ($request->get( 'guest' ) == 1 and empty( $guestID )) {
            return $next( $request );
        }
        // normal auth
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response( 'Unauthorized.', 401 );
            } else {

                return redirect()->guest( 'checkout/auth' );
            }
        }

        return $next( $request );
    }

}

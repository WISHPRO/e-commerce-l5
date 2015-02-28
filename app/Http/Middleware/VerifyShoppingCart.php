<?php namespace App\Http\Middleware;

use Closure;

class VerifyShoppingCart
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cart = cartExists(true);

        if ($cart) {
            if ($cart->hasItems()) {
                return $next($request);
            }

            return view('frontend.Cart.index');

        }

        return view('frontend.Cart.index');

    }

}

<?php namespace App\Http\Middleware;

use Closure;

class CheckOutAsAuthUser
{

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
        if (!is_null($request->user())) {
            return $next($request);
        }
        return redirect()->route('checkout.auth');
    }

}

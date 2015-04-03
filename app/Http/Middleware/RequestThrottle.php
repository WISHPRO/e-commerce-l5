<?php namespace App\Http\Middleware;

use Closure;
use GrahamCampbell\Throttle\Facades\Throttle;

class RequestThrottle
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
        $throttler = Throttle::get($request, 10, 1);

        if ($throttler->check()) {

            return redirect()->back()->with('recaptcha', true);
        }

        return $next($request);
    }

}

<?php namespace App\Http\Middleware;

use Closure;
use Redirect;
use Request;

class RequireSSL
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
        if (!$request->isSecure()) {
            return redirect()->secure(Request::path());
        }

        return $next($request);
    }

}

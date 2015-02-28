<?php namespace App\Http\Middleware;

use Closure;
use Redirect;
use Request;

class RemoveSSL
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
        if (Request::secure()) {
            return Redirect::to(Request::path(), 302, [], false);
        }

        return $next($request);
    }

}

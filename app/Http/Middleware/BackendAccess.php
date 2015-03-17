<?php namespace App\Http\Middleware;

use Closure;

class BackendAccess
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
        // check the ip address
        if (in_array($request->getClientIp(), config('site.backend.allowedIPS'))) {
            return $next($request);
        }
        abort('403', 'You are not allowed to access this page from your ip address of ' . $request->getClientIp());
    }

}

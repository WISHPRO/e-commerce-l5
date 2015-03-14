<?php namespace App\Http\Middleware;

use Closure;

class BackendAuthorization {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        // check if the user has some role
        if($request->user()->hasRole([config('site.backend.allowedRoles', 'Administrator')])){
            return $next($request);
        }
		abort('401', 'You are not authorized to access this page');
	}

}

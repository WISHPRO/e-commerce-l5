<?php namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Redirect;
use Request;


class BackendAccess {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (strcmp(Request::getClientIp(), '127.0.0.1') != 0)
		{
			abort('403', 'FORBIDDEN');
		}
		if (!\Auth::user()->hasRole('Administrator'))
		{
			abort('401', 'UNAUTHORIZED');
			//Redirect::route('admin.login')->with('message', 'verify your credentials and try again')->with('alertclass', 'alert-danger');
		}

		return $next($request);
	}

}

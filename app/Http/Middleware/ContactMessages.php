<?php namespace App\Http\Middleware;

use Closure;

class ContactMessages
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
        if (!is_null(session('contact_message_sent'))) {

            if ($request->ajax()) {
                return response()->json(['message' => 'Your message has already been message']);
            } else {
                flash('Your message has already been message');

                return redirect()->back();
            }

        } else {
            return $next($request);
        }

    }

}

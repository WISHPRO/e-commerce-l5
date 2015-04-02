<?php namespace App\Http\Middleware;

use app\Antony\DomainLogic\Contracts\Contact\ContactMessageContract as MsgResult;
use Closure;

class AnonymousContactMessages implements MsgResult
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
        // check if the current user has already sent a contact message
        $status = session(MsgResult::MESSAGE_SENT);

        if (is_null($status)) {
            return $next($request);
        } else {

            if ($request->ajax()) {
                return response()->json(['message' => 'Your message has already been sent'], 202);
            } else {
                flash()->warning('Your message has already been sent');
                return redirect()->back();
            }

        }


    }

}

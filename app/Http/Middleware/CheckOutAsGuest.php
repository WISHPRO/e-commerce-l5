<?php namespace App\Http\Middleware;

use app\Antony\DomainLogic\Modules\Checkout\Guest\GuestBillingAddress;
use Closure;

class CheckOutAsGuest
{

    /**
     * @var GuestBillingAddress
     */
    private $guest;

    /**
     * @param GuestBillingAddress $guest
     */
    public function __construct(GuestBillingAddress $guest)
    {

        $this->guest = $guest;
    }

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
        if ($request->get('allow') === "1" & empty($this->guest->getCookieData())) {

            return $next($request);
        }

        if ($this->guest->isAGuest()) {
            return $next($request);
        }
        return redirect()->guest('checkout/auth');
    }

}

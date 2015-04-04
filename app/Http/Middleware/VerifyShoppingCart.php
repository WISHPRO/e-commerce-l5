<?php namespace App\Http\Middleware;

use App\Antony\DomainLogic\modules\Cookies\ShoppingCartCookie;
use Closure;

class VerifyShoppingCart
{

    private $cookie;

    public function __construct(ShoppingCartCookie $cartCookie)
    {
        $this->cookie = $cartCookie;
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
        if ($this->cookie->exists()) {
            return $next($request);
        }

        return view('Frontend.Cart.index');

    }

}

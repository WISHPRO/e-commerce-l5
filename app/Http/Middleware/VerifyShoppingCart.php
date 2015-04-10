<?php namespace App\Http\Middleware;

use app\Antony\DomainLogic\Modules\ShoppingCart\ShoppingCart;
use Closure;

class VerifyShoppingCart
{
    /**
     * The shopping cart
     *
     * @var ShoppingCart
     */
    private $shoppingCart;

    /**
     * @param ShoppingCart $cart
     */
    public function __construct(ShoppingCart $cart)
    {
        $this->shoppingCart = $cart;
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
        // check if the shopping cart has any items
        if ($this->shoppingCart->hasProducts()) {

            return $next($request);
        }

        return view('Frontend.Cart.index');
    }

}

<?php namespace app\Anto\Composers;

use app\Models\Cart;

class ShoppingCartComposer extends ViewComposer{

    protected $outputVariable = "cartItems";

    public function cachingEnabled()
    {
        return false;
    }

    protected function fillComposer()
    {
        $cart = cartExists(true);
        if($cart != false)
        {
            if($cart->hasItems($cart))
            {
                return Cart::with( 'products.carts', 'products.reviews' )->where(
                    'id',
                    session('shopping_cart')
                )->get();
            }
            return null;
        }
        return null;
    }
}
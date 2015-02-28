<?php namespace app\Anto\Composers;

use app\Models\Cart;

class ShoppingCartComposer extends ViewComposer
{

    protected $outputVariable = "cartItems";

    public function cachingEnabled()
    {
        return false;
    }

    protected function fillComposer()
    {
        if (cartExists(false, false)) {
            $id = cartCookieValue();

            return Cart::with('products.carts', 'products.reviews')->where(
                'id',
                $id
            )->get();
        }

        return null;

    }
}
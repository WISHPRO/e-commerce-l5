<?php namespace App\Antony\DomainLogic\Modules\Checkout;

use App\Antony\DomainLogic\Modules\ShoppingCart\Formatters\MoneyFormatter;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

trait ShoppingCartTrait
{
    /**
     * Allow us to check if a cart has any items
     *
     * @param Cart $cart
     *
     * @return bool
     */
    public function hasItems()
    {
        return $this->getTotalBasketCount() > 0;
    }

    /**
     * Allow us to easily count the total number of products in the user's shopping cart
     * However, this works on a per-product basis, and doesn't take into account individual product quantities.
     * so it can only display sth like ==> product A = 1 items, even though the user added two of this products in the
     * cart
     *
     * @param Cart $cart
     *
     * @return mixed
     */
    public function getTotalBasketCount()
    {
        return $this->products->count();
    }


    /**
     * Returns the subtotal of all products in a shopping cart
     *
     * @return mixed
     */
    public function getSubTotal()
    {
        $sum = null;
        foreach ($this->products as $product) {

            $sum = $this->value($product, $this->getSingleProductQuantity($product));

            $sum->add($sum);
        }

        $formatter = new MoneyFormatter();

        return $formatter->format($sum);

    }

    /**
     * Allow us to get the quantity of a single product in a user's shopping cart
     * The query assumes presence of a pivot in the collection, so if the query fails, we just return 1
     *
     * @param Product $product
     *
     * @return int
     */
    public function getSingleProductQuantity(Product $product)
    {
        // access the pivot that came with the collection. Cart::with('products.carts')->where('id', .....
        // table cart_product has a quantity field, which we then access via the pivot
        $qt = $product->pivot->quantity;

        // If the query fails for some reason, just return 1
        return $qt == null ? 1 : $qt;
    }

    /**
     * Allow us to get the total number of items in the current basket, on a per individual product basis
     * so, if a user added a product with quantity = 2, then the value returned will be 2 ...etc
     *
     * @param Cart $cart
     *
     * @return int
     */
    public function getAllProductsQuantity()
    {
        // just count all the items in the current cart, per -->
        return $this->products->sum(
            function ($product) {
                // access the pivot value, which is quantity. then use it for getting the sum
                return $product->pivot->quantity;
            }
        );
    }
}
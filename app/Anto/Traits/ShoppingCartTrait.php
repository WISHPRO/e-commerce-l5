<?php namespace app\Anto\Traits;

use app\Models\Cart;
use app\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait ShoppingCartTrait {

    private $cartExists = false;

    private $cartHasProducts = false;

    /**
     * Allows us to generate a cart ID
     *
     * @param bool $number
     *
     * @return string
     */
    function generateCartID( $number = true )
    {
        $value = $number ? generateRandomInt() : str_random( 10 );

        return $value;
    }

    /**
     * Allows us to check if a shopping cart exists, both in the session,
     * and cross check with database if needed. by default, we crosscheck
     *
     * @return bool
     */
    function verifyCart( $crossCheckWithDB = true )
    {
        // no need to proceed if there's no cart to start with
        if (cartExists())
        {
            return false;
        }

        if ($crossCheckWithDB) {
            // verify that the cart exists in the database
            $cart = cartExists(true);

            if ($cart == null) {
                return false;
            }

            return $cart;
        }

        return cartExists();
    }

    /**
     * Get the cart ID from the current session
     *
     * @return mixed
     */
    function retrieveCartIDFromSession()
    {
        if(!is_null(session( 'shopping_cart' )))
        {
            $this->cartExists = true;

            return session('shopping_cart');
        }
        return null;
    }

    /**
     * Allows us to create a new shopping cart, or reuse the existing one, if indeed it exists
     *
     * @return Cart|Collection|null|static
     */
    function createCartIfNotExist()
    {
        return !cartExists() ? $this->createNewCart() : cartExists(true);
    }

    /**
     * Allows us to save a shopping cart in the current user's session
     *
     * @param Cart $cart
     */
    function SaveCartInSession( Cart $cart )
    {
        \Session::put( 'shopping_cart', $cart->id );
    }

    /**
     * Allows us to create a new shopping cart
     *
     * @return Cart
     */
    function createNewCart()
    {
        $cart = new Cart();
        $cart->id = $this->generateCartID();
        // if user is logged in, we associate the cart with him/her
        if (\Auth::check()) {
            \Auth::user()->shopping_carts()->save( $cart );

            $this->SaveCartInSession( $cart );

            return $cart;
        }

        $cart->save();

        $this->SaveCartInSession( $cart );

        return $cart;
    }

    /**
     * self explanatory
     * The param returnData specifies if the function should return the intermediate values from querying the database
     * This way, checking if null can be done later, and allows us to pluck some values from that data
     *
     * @param $id
     *
     * @return bool
     */
    function checkForExistingProduct( $id, $returnData = true )
    {
        $cart_id = $this->retrieveCartIDFromSession();

        if ($cart_id == null) {

            return false;
        }
        $data = $this->queryDB( $id, $cart_id );

        return $returnData ? $data : !empty( $data );
    }


    /**
     * Query the database for an existing product in the current shopping cart
     *
     * @param $id
     * @param $cart_id
     *
     * @return array
     */
    function queryDB( $id, $cart_id )
    {
        return \DB::select(
            "SELECT `product_id`, `quantity` FROM `cart_product` WHERE product_id = ? AND cart_id = ?",
            [ $id, $cart_id ]
        );
    }

    /**
     * Allow us to check if a cart has any items
     *
     * @param Cart $cart
     *
     * @return bool
     */
    function hasItems(Cart $cart = null)
    {
        return $this->getTotalBasketCount($cart == null ? cartExists(true) : $cart) > 0;
    }

    /**
     * Get exiting quantity of a product in the shopping cart
     *
     * @param $data
     *
     * @return int|null
     */
    function getExistingQtInDB( $data )
    {
        if (empty( $data )) {
            return null;
        }

        // get the quantity
        return (int) array_pluck( $data, 'quantity' );
    }

    /**
     * update the existing quantity of a product in the shopping cart
     *
     * @param $existingQt
     * @param $newQuantity
     * @param $productID
     */
    function updateExistingQuantity($existingQt, $newQuantity, $productID, $forceUpdate = false )
    {
        $qt = $forceUpdate ? $newQuantity : $existingQt + $newQuantity;

        $this->products()->updateExistingPivot( $productID, [ 'quantity' => $qt ] );
    }

    /**
     * Allows for removal of a product from the cart
     * Works on a per-product basis
     *
     * @param Cart $model
     * @param      $productID
     *
     * @return int
     */
    function removeProductFromCart( Cart $model, $productID )
    {
        return $model->products()->detach( $productID );
    }

    /**
     * Allow us to easily count the total number of products in the user's shopping cart
     * However, this works on a per-product basis, and doesnt take into account individual product quantities.
     * so it can only display sth like ==> product A = 1 items, even though the user added two of this products in the
     * cart
     *
     * @param Cart $cart
     *
     * @return mixed
     */
    function getTotalBasketCount()
    {
        return $this->products->count();
    }

    /**
     * Allow us to get the total number of items in the current basket, on a per individual product basis
     * so, if a user added a product with quantity = 2, then the value returned will be 2 ...etc
     *
     * @param Cart $cart
     *
     * @return int
     */
    function getTotalBasketCountByExistingQuantity()
    {
        // just count all the items in the current cart, per -->
        return $this->products->sum(
            function ( $product ) {
                // access the pivot value, which is quantity. then use it for getting the sum
                return $product->pivot->quantity;
            }
        );
    }

    /**
     * Allow us to get the quantity of a single product in a user's shopping cart
     * The query assumes presence of a pivot in the collection, so if the query fails, we just return 1
     *
     * @param Product $product
     *
     * @return int
     */
    function getSingleProductQt( Product $product )
    {
        // access the pivot that came with the collection. Cart::with('products.carts')->where('id', .....
        // table cart_product has a quantity field, which we then access via the pivot
        $qt = $product->pivot->quantity;

        // If the query fails for some reason, just return 1
        return $qt == null ? 1 : $qt;
    }

    /**
     * Allows us to calculate the price of a product in the shopping cart
     * We of course take into account the quantity of a single product and its discount
     *
     * @param Product $product
     *
     * @return float|mixed
     */
    function getProductPrice( Product $product )
    {
        return hasDiscount( $product )
            ? calculateDiscount( $product, true ) * $this->getSingleProductQt( $product )
            : $product->price * $this->getSingleProductQt( $product );
    }

    /**
     * Calculate the subtotal of products in the cart
     *
     * @param Model $cart
     *
     * @return mixed
     */
    function cartSubTotal()
    {
        return $this->products->sum(
            function ( $product ) {
                // just call the function above us!!
                return $this->getProductPrice( $product );
            }
        );
    }
}
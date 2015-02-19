<?php

// Functions for the shopping cart

use app\Models\Cart;
use app\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Allows us to generate a cart ID
 * @param bool $number
 * @return string
 */
function generateCartID($number = true)
{
    $value = $number ? generateRandomInt() : str_random(10);
    return $value;
}

/**
 * Allows us to check if a shopping cart exists, both in the session,
 * and cross check with database if needed. by default, we crosscheck
 * @return bool
 */
function shoppingCartExists($crossCheckWithDB = true)
{
    // no need to proceed if there's no cart to start with
    if(getCartID() == null)
    {
        return false;
    }

    if($crossCheckWithDB)
    {
        // verify that the cart exists
        $cart = queryExisting();

        if($cart == null)
        {
            return false;
        }
        return $cart;
    }

    return \Session::has('shopping_cart');
}

/**
 * Allows us to check if a cart exists. just a wrapper around the getShoppingCart function
 * @return bool
 */
function cartExists()
{
    return getCartID() != null;
}

/**
 * Allows us to check the database for an existing cart
 * @return Collection|null|static
 */
function queryExisting()
{
    return Cart::find(getCartID());
}

/**
 * @return mixed
 */
function getCartID()
{
    return session('shopping_cart');
}

/**
 * Allows us to create a new shopping cart, or reuse the existing one, based on its existence
 * @return Cart|Collection|null|static
 */
function createCartIfNotExist()
{
    if(getCartID() == null)
    {
        return createNewCart();
    }
    else{
        return queryExisting();
    }
}

/**
 * Allows us to save a shopping cart in the user's session
 * @param Cart $cart
 */
function SaveCartInSession(Cart $cart)
{
    \Session::put('shopping_cart', $cart->id);
}

/**
 * Allows us to create a new shopping cart
 * @return Cart
 */
function createNewCart()
{
    $cart = new Cart();
    $cart->id = generateCartID();
    // if user is logged in, we associate the cart with him/her
    if(\Auth::check())
    {
        Auth::user()->shopping_carts()->save($cart);

        SaveCartInSession($cart);

        return $cart;
    }

    $cart->save();

    SaveCartInSession($cart);

    return $cart;
}

/**
 * Allows us to check if a product already exists in the current shopping cart
 * I used a plain SQL query, for simplicity
 * @param $id
 * @return bool
 */
function checkForExistingProduct($id)
{
    $cart_id = getCartID();

    // if there's no cart, we just bail out
    if($cart_id == null)
    {
        return false;
    }
    else {

        $product = \DB::select("SELECT `product_id` FROM `cart_product` WHERE product_id = ? AND cart_id = ?", [$id, $cart_id]);

        // we negate this, for obvious reasons
        return ! empty($product);
    }

}

/**
 * Allow us to easily count the total number of products in the user's shopping cart
 * @param Cart $cart
 * @return mixed
 */
function getTotalBasketCount(Cart $cart)
{
    return $cart->products->count();
}

/**
 * Allow us to get the number of individual products in a user's shopping cart
 * The query assumes presence of a pivot in the collection, so if the query fails, we just return 1
 * @param Product $product
 * @return int
 */
function getCartPQt(Product $product)
{
    // access the pivot that came with the collection. Cart::with('products.carts')->where('id', .....
    // table cart_product has a quantity field, which we then access via the pivot
    $qt = $product->pivot->quantity;

    // If the query fails for some reason, just return 1
    return $qt == null ? 1 : $qt;
}

/**
 * Allows us to calculate the price of a product in the shopping cart
 * @param Product $product
 * @param $quantity
 * @return float|mixed
 */
function getProductPrice(Product $product)
{
    if(hasDiscount($product)){

        return calculateDiscount($product, true) * getCartPQt($product);
    }
    else {

        return $product->price * getCartPQt($product);
    }
}

/**
 * Calculate the subtotal of products in the cart
 * @param Model $cart
 * @return mixed
 */
function getCartSubTotal(Model $cart, $out = false)
{
    return $cart->products->sum( function($product ){
        // just call the function above us!!
        return getProductPrice($product);
    });
}

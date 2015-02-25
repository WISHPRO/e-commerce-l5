<?php
/**
 * Allows us to check if a cart exists. just a wrapper around the getShoppingCart function
 *
 * @return bool
 */
function cartExists($returnInstance = false)
{
    if($returnInstance){
        $cartID = session('shopping_cart');
        if($cartID == null){
            return false;
        } else {
            return \app\Models\Cart::find($cartID);
        }
    } else {
        return session('shopping_cart') == null;
    }

}
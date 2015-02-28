<?php
/**
 * Created by PhpStorm.
 * User: anto
 * Date: 2/24/15
 * Time: 2:43 PM
 */
namespace app\Anto\Repositories;

interface ShoppingCartRepository
{
    /**
     * Allows us to generate a cart ID
     *
     * @param bool $number
     *
     * @return string
     */
    function generateCartID($number = true);

    /**
     * Allows us to check if a shopping cart exists, both in the session,
     * and cross check with database if needed. by default, we crosscheck
     *
     * @return bool
     */
    function verifyCart($crossCheckWithDB = true);

    /**
     * Allows us to check if a cart exists. just a wrapper around the getShoppingCart function
     *
     * @return bool
     */
    function cartExists();

    /**
     * Allows us to check the database for an existing cart ID
     *
     * @return Collection|null|static
     */
    function queryExisting();

    /**
     * Get the cart ID from the current session
     *
     * @return mixed
     */
    function retrieveCartIDFromSession();

    /**
     * Allows us to create a new shopping cart, or reuse the existing one, if indeed it exists
     *
     * @return \app\Anto\Classes\ShoppingCart|Collection|null|static
     */
    function createCartIfNotExist();

    /**
     * Allows us to save a shopping cart in the current user's session
     *
     * @param \app\Anto\Classes\ShoppingCart $cart
     */
    function SaveCartInSession();

    /**
     * Allows us to create a new shopping cart
     *
     * @return \app\Anto\Classes\ShoppingCart
     */
    function createNewCart();

    /**
     * self explanatory
     * The param returnData specifies if the function should return the intermediate values from querying the database
     * This way, checking if null can be done later, and allows us to pluck some values from that data
     *
     * @param $id
     *
     * @return bool
     */
    function checkForExistingProduct($id, $returnData = true);

    /**
     * Query the database for an existing product in the current shopping cart
     *
     * @param $id
     * @param $cart_id
     *
     * @return array
     */
    function queryDB($id, $cart_id);

    /**
     * Allow us to check if a cart has any items
     *
     * @param \app\Anto\Classes\ShoppingCart $cart
     *
     * @return bool
     */
    function hasItems();

    /**
     * update the existing quantity of a product in the shopping cart
     *
     * @param $existingQt
     * @param $newQuantity
     * @param $productID
     */
    function updateExistingQuantity(
        $cart,
        $existingQt,
        $newQuantity,
        $productID,
        $forceUpdate = false
    );

    /**
     * Allows for removal of a product from the cart
     * Works on a per-product basis
     *
     * @param \app\Anto\Classes\ShoppingCart $model
     * @param                                $productID
     *
     * @return int
     */
    function removeProductFromCart($cart, $productID);

    /**
     * Allow us to easily count the total number of products in the user's shopping cart
     * However, this works on a per-product basis, and doesnt take into account individual product quantities.
     * so it can only display sth like ==> product A = 1 items, even though the user added two of this products in the
     * cart
     *
     * @param \app\Anto\Classes\ShoppingCart $cart
     *
     * @return mixed
     */
    function getTotalBasketCount($cart);

    /**
     * Allow us to get the total number of items in the current basket, on a per individual product basis
     * so, if a user added a product with quantity = 2, then the value returned will be 2 ...etc
     *
     * @param \app\Anto\Classes\ShoppingCart $cart
     *
     * @return int
     */
    function getTotalBasketCountByExistingQuantity($cart);

    /**
     * Allow us to get the quantity of a single product in a user's shopping cart
     * The query assumes presence of a pivot in the collection, so if the query fails, we just return 1
     *
     * @param Product $product
     *
     * @return int
     */
    function getSingleProductQuantity($product);

    /**
     * Calculate the subtotal of products in the cart
     *
     * @param Model $cart
     *
     * @return mixed
     */
    function getCartSubTotal($cart);
}
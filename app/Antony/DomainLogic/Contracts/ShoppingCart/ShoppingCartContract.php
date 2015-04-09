<?php namespace app\Antony\DomainLogic\Contracts\ShoppingCart;

interface ShoppingCartContract
{
    /**
     * Constant representing an successful addition of a product to the shopping cart
     *
     * @var string
     */
    const PRODUCT_ADDED_TO_CART = 'product.added';

    /**
     * Constant representing a failed attempt to add a product to the shopping cart
     *
     * @var string
     */
    const ADD_PRODUCT_FAILED = 'product.add.to.cart.failed';

    /**
     * Constant representing a successful update of an existing product in the shopping cart
     *
     * @var string
     */
    const PRODUCT_UPDATED = 'product.updated';

    /**
     * Constant representing an failed update of an existing product
     *
     * @var string
     */
    const UPDATE_PRODUCT_FAILED = 'product.update.failed';

    /**
     * Constant representing a successful update of a product in the shopping cart (from the products in cart list page)
     *
     * @var string
     */
    const CART_PRODUCT_UPDATED = 'product.in.cart.updated';

    /**
     * Constant representing a failed update of a product in the shopping cart (from the products in cart list page)
     *
     * @var string
     */
    const CART_PRODUCT_UPDATE_FAILED = 'product.in.cart.update.failed';

    /**
     * Constant representing a successful removal of an existing product
     *
     * @var string
     */
    const CART_REMOVE_PRODUCT_SUCCESS = 'product.in.cart.removed';

    /**
     * Constant representing an failed removal of an existing product
     *
     * @var string
     */
    const CART_REMOVE_PRODUCT_FAILED = 'product.in.cart.remove.failed';

    /**
     * Allows a user to create a shopping cart
     *
     * @param $request
     * @param $productID
     *
     * @return mixed
     */
    public function create($request, $productID);

    /**
     * Allows a user to view products in their shopping cart
     *
     * @return mixed
     */
    public function retrieveProductsInCart();

    /**
     * Allows a user to update their shopping cart
     *
     * @param $request
     * @param $productID
     *
     * @return mixed
     */
    public function updateShoppingCart($request, $productID);

    /**
     * Allows a user to remove a product from their shopping cart
     *
     * @param $productID
     *
     * @return mixed
     */
    public function removeProduct($productID);

}
<?php namespace App\Antony\DomainLogic\Contracts\ShoppingCart;

use App\Models\Product;
use Money\Money;

interface Reconciler
{
    /**
     * Return the value of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function value(Product $product = null);

    /**
     * Return the discount of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function discount(Product $product = null);

    /**
     * Return the delivery charge of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function delivery(Product $product = null);

    /**
     * Return the tax of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function tax(Product $product = null);

    /**
     * Return the subtotal of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function subtotal(Product $product = null);

    /**
     * Return the total of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function total(Product $product = null);
}

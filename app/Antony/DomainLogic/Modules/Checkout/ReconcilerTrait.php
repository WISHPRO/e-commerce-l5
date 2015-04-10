<?php namespace App\Antony\DomainLogic\Modules\Checkout;

use App\Antony\DomainLogic\Modules\ShoppingCart\Formatters\MoneyFormatter;
use app\Antony\DomainLogic\Modules\ShoppingCart\Tax\KenyanTaxRate;
use App\Models\Product;
use Money\Currency;
use Money\Money;

trait ReconcilerTrait
{
    /**
     * Return the value of the Product
     *
     * @param Product $product
     *
     * @param int $quantity
     *
     * @return Money
     */
    public function value(Product $product, $quantity = 1)
    {
        if ($quantity <= 0) {
            return $product->getPriceAfterDiscount(false, true);
        }
        return $product->getPriceAfterDiscount(false, true)->multiply($quantity);
    }

    /**
     * Return the discount of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function discount(Product $product)
    {
        $discount = $this->money($product);

        if ($product->discount) {
            $discount = $product->discount->product($product);
            $discount = $discount->multiply($product->quantity);
        }

        return $discount;
    }

    /**
     * Return the delivery charge of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function delivery(Product $product)
    {
        $delivery = $product->shipping->multiply($this->getSingleProductQuantity($product));

        return $delivery;
    }

    /**
     * Return the tax of the Product
     *
     * @param Product $product
     *
     * @param int $quantity
     *
     * @return Money
     */
    public function tax(Product $product, $quantity = 1)
    {
        $rate = new KenyanTaxRate();

        $tax = $this->money($product);

        if (!$product->taxable || $product->free) {
            return $tax;
        }

        $value = $this->value($product, $quantity);
        $discount = $this->discount($product);

        $value = $value->subtract($discount);
        $tax = $value->multiply($rate->float());

        return $tax;
    }

    /**
     * Return the subtotal of the Product
     *
     * @param Product $product
     *
     * @param int $quantity
     *
     * @return Money
     */
    public function subtotal(Product $product, $quantity = 1)
    {
        $subtotal = $this->money($product);

        if (!$product->free) {
            $value = $this->value($product, $quantity);
            $subtotal = $subtotal->add($value);
        }

        $delivery = $this->delivery($product);
        $subtotal = $subtotal->add($delivery);

        return $subtotal;
    }

    /**
     * Return the total of the Product
     *
     * @param Product $product
     *
     * @param int $quantity
     *
     * @return Money
     */
    public function total(Product $product, $quantity = 1)
    {
        $tax = $this->tax($product);
        $subtotal = $this->subtotal($product, $quantity);
        $total = $subtotal->add($tax);

        return $total;
    }

    /**
     * Create an initial zero money value
     *
     * @param Product $product
     *
     * @return Money
     */
    private function money(Product $product)
    {
        return new Money(0, $product->price->getCurrency());
    }

    /**
     * Formats a money object to price + value. eg Money A becomes KSH 10000
     *
     * @param $money
     *
     * @return mixed
     */
    public function formatMoneyValue($money)
    {
        if (!$money instanceof Money) {

            $money = new Money($money, new Currency($this->defaultCurrency));
        }
        $formatter = new MoneyFormatter();

        return $formatter->format($money);
    }
}
<?php namespace app\Antony\DomainLogic\Modules\ShoppingCart;

use App\Antony\DomainLogic\Contracts\ShoppingCart\Reconciler;
use App\Antony\DomainLogic\Modules\ShoppingCart\Formatters\MoneyFormatter;
use app\Antony\DomainLogic\Modules\ShoppingCart\Tax\KenyanTaxRate;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Money\Currency;
use Money\Money;

class DefaultReconciler extends Model implements Reconciler
{
    /**
     * Product quantity
     *
     * @var int
     */
    protected $qt = 1;

    /**
     * @param $value
     *
     * @return $this
     */
    public function quantity($value)
    {
        $this->qt = $value;

        return $this;
    }

    /**
     * Return the total of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function total(Product $product = null)
    {
        $product = $this->checkProductInstance($product);

        $tax = $this->tax($product);
        $subtotal = $this->subtotal($product);
        $total = $subtotal->add($tax);
        return $total;
    }

    /**
     * @param Product $product
     *
     * @return $this|Product
     */
    public function checkProductInstance(Product $product = null)
    {
        if (is_null($product)) {
            return $this;
        }
        return $product;
    }

    /**
     * Return the tax of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function tax(Product $product = null)
    {
        $product = $this->checkProductInstance($product);

        $rate = new KenyanTaxRate();

        $tax = $this->money($product);

        if (!$product->taxable || $product->free) {
            return $tax;
        }

        $value = $this->value($product, $this->qt);
        $discount = $this->discount($product);

        $value = $value->subtract($discount);
        $tax = $value->multiply($rate->float());

        return $tax;
    }

    /**
     * Create an initial zero money value
     *
     * @param Product $product = null
     *
     * @return Money
     */
    private function money(Product $product)
    {
        return new Money(0, $product->price->getCurrency());
    }

    /**
     * Return the value of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function value(Product $product = null)
    {
        $product = $this->checkProductInstance($product);

        return $product->price->multiply($this->qt);
    }

    /**
     * Return the discount of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function discount(Product $product = null)
    {
        $product = $this->checkProductInstance($product);

        $discount = $this->money($product);
        if ($product->discount) {
            $discount = $product->discount->product($product);
            $discount = $discount->multiply($this->qt);
        }
        return $discount;
    }

    /**
     * Return the subtotal of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function subtotal(Product $product = null)
    {
        $product = $this->checkProductInstance($product);

        $subtotal = $this->money($product);
        if (!$product->freebie) {
            $value = $this->value($product);
            $discount = $this->discount($product);
            $subtotal = $subtotal->add($value)->subtract($discount);
        }
        $delivery = $this->delivery($product);
        $subtotal = $subtotal->add($delivery);
        return $subtotal;
    }

    /**
     * Return the delivery charge of the Product
     *
     * @param Product $product
     *
     * @return Money
     */
    public function delivery(Product $product = null)
    {
        $product = $this->checkProductInstance($product);

        $delivery = $product->shipping->multiply($this->qt);
        return $delivery;
    }

    /**
     * @param Product $product
     *
     * @return Money
     */
    public function valuePlusTax(Product $product = null)
    {
        $product = $this->checkProductInstance($product);

        return $this->value($product)->add($this->tax($product));
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
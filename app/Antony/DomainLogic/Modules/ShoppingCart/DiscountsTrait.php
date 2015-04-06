<?php namespace app\Antony\DomainLogic\Modules\ShoppingCart;

use App\Antony\DomainLogic\Modules\ShoppingCart\Discounts\ValueDiscount;
use App\Antony\DomainLogic\Modules\ShoppingCart\Formatters\MoneyFormatter;

trait DiscountsTrait
{

    /**
     * Get the price of a product after we have subtracted the discount
     *
     * @param bool $format
     *
     * @return mixed
     */
    public function getPriceAfterDiscount($format = true, $returnMoneyInstance = false)
    {
        $value = new ValueDiscount($this->discount->product($this));

        if ($format) {
            $formatter = new MoneyFormatter();
            return $formatter->format($this->price->subtract($value->toMoney()));
        }

        return $returnMoneyInstance ? $this->price->subtract($value->toMoney()) : $this->price->subtract($value->toMoney())->getAmount();
    }

    /**
     * Get the amount incurred after a discount
     *
     * @param bool $format
     *
     * @return mixed
     */
    public function getDiscountAmount($format = true)
    {
        if ($format) {
            $formatter = new MoneyFormatter();
            return $formatter->format($this->discount->product($this));
        }

        return $this->discount->product($this)->getAmount();
    }

    /**
     * Get a products discount rate
     *
     * @return mixed
     */
    public function getDiscountRate()
    {
        return $this->discount->rate()->int();
    }

    /**
     * Allows us to check if a product has a discount
     *
     * @return bool
     */
    public function hasDiscount()
    {
        return $this->discount->rate()->int() != 0;
    }
}
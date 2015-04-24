<?php namespace App\Antony\DomainLogic\Modules\Product;

use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Collection;

trait ProductTrait
{

    /**
     * Returns the name of a product
     *
     * @return string
     */
    public function name()
    {
        return beautify($this->name);
    }

    /**
     * Gets the price of a product, with an option to format it
     *
     * @param bool $format
     *
     * @return mixed
     */
    public function getPrice($format = true)
    {
        if ($format) {

            return format_money($this->getPriceAfterTax($this));
        }

        return $this->getPriceAfterTax($this)->getAmount();

    }

    /**
     * Returns the shipping cost of a product
     *
     * @param bool $format
     *
     * @return mixed
     */
    public function getShippingCost($format = true)
    {
        if ($format) {

            return format_money($this->shipping);
        }

        return $this->shipping->getAmount();
    }

    /**
     * Determines if a product is new
     *
     * @return bool
     */
    public function isNew()
    {
        $byWhen = new Carbon('last friday');

        return $this->created_at >= $byWhen;
    }

    /**
     * Checks if a product is taxable
     *
     * @return bool
     */
    public function isTaxable()
    {
        return $this->getTaxableStatus();
    }

    /**
     * Checks is a product needs to display a low warning in stock message to the client
     *
     * @return bool
     */
    public function needsStockWarning()
    {
        return $this->quantity <= config('site.products.quantity.low_threshold', 2) & !$this->hasRanOutOfStock();
    }

    /**
     * determine if a product has ran out of stock
     *
     * @return bool
     */
    public function hasRanOutOfStock()
    {
        return empty($this->quantity);
    }

    /**
     * Checks if a product needs a text input field for quantity
     *
     * @return bool
     */
    public function needsTextInputForQuantity()
    {
        return $this->quantity <= config('site.products.quantity.max_selectable', 10);
    }

    /**
     * Displays products related to the current product
     *
     * @return Collection
     */
    public function getRelated()
    {

        $currentProduct = $this;

        $data = $this->subcategories()->with('products.reviews')->whereId($this->subcategories->implode('id'))->get();

        // if a product related to the current product's subcategory wasn't found, we try finding
        // those related to it's category
        if ($data->count() === 0) {

            $data = $this->categories()->with('products.reviews')->whereId($this->categories->implode('id'))->get();
        }

        $output = new Collection();

        // streamline the collection to only include the product objects
        foreach ($data as $subcategory) {

            foreach ($subcategory->products as $product) {

                $output->push($product);
            }

        }

        // prevent the current product from being displayed in this list, and also limit items returned to 10
        $output = $output->filter(function ($item) use ($currentProduct) {

            return $item->id !== $currentProduct->id;

        })->take(10);

        return $output->sortBy(function ($p) {
            $p->name;
        });
    }
}
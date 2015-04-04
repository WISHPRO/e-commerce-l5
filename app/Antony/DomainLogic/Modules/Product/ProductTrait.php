<?php namespace App\Antony\DomainLogic\Modules\Product;

use App\Antony\DomainLogic\Modules\ShoppingCart\Formatters\MoneyFormatter;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Money\Money;

trait ProductTrait
{

    /**
     * The default currency that we are using
     *
     * @var string
     */
    protected $defaultCurrency = 'KES';

    /**
     * @return string
     */
    public function name()
    {
        return beautify($this->name);
    }

    /**
     * @param bool $format
     *
     * @return mixed
     */
    public function getPrice($format = true)
    {
        if ($format) {

            return $this->formatMoneyValue($this->price);
        }

        return $this->price->getAmount();

    }

    public function formatMoneyValue(Money $money)
    {
        $formatter = new MoneyFormatter();
        return $formatter->format($money);
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
     * Determines if a product is taxable
     *
     * @return bool
     */
    public function isTaxable()
    {
        $this->taxable = $this->model->getPrice(false) >= config('site.products.taxableThreshold');

        return $this->taxable;
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

        // prevent the current product from being displayed in this list
        $output = $output->filter(function ($item) use ($currentProduct) {

            return $item->id !== $currentProduct->id;

        })->take(5);

        return $output;
    }
}
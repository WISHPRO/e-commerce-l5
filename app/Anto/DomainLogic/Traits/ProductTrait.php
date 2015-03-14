<?php namespace app\Anto\domainLogic\Traits;

use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;

trait ProductTrait
{
    /**
     * @param Product $collection
     *
     * @return mixed
     */
    public static function getWholeCollectionReviewCount(Product $collection)
    {
        $count = $collection->reviews->unique()->count();

        return $count;
    }

    /**
     * @return string
     */
    public function name()
    {
        return beautify($this->name);
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
        return $this->price >= config('site.products.taxableThreshold');
    }

    /**
     * Determine if a product is 'HOT'
     *
     * @return bool
     */
    public function isHot()
    {
        return $this->getAverageRating()
        >= config('site.reviews.hottest')
        && $this->getSingleProductReviewCount()
        >= config('site.reviews.count');
    }

    /**
     * Okay, this attempts to calculate the average rating of a product
     *
     * @return float
     *
     */
    public function getAverageRating()
    {
        // get the total unique stars given for this product
        $total = $this->reviews->unique()->fetch('stars')->sum();
        // count all unique reviews for this product
        $count = $this->getSingleProductReviewCount();
        // avoid division by 0
        if (empty($count)) {
            return 0;
        }

        return $total / $count;
    }

    /**
     * Allows us to get the total number of unique reviews for a particular product
     *
     * @return int|null
     */
    public function getSingleProductReviewCount()
    {
        return $this->reviews->unique()->count();
    }

    /**
     * Generate a sample product SKU
     *
     * @return string
     */
    public function generateProductSKU()
    {
        return 'PCW' . int_random();
    }

    /**
     * @return float
     */
    public function determineFinalPrice()
    {
        $discount = $this->calculateDiscount(true);

        $tax = $this->calculateTax();

        return $discount + $tax;
    }

    /**
     * @return float|int
     */
    public function calculateTax()
    {
        if ($this->isTaxable()) {
            return round(config('site.products.VAT', 16) / 100 * $this->price, 2);
        }

        return 0;
    }

    /**
     * Allows us to calculate the discount of a product, with an option of
     * returning the discount amount, or the final price after subtracting
     * the discount amount. default is to just return the discount amount
     *
     * @param bool $getFinal
     *
     * @return float
     */
    public function calculateDiscount($getFinal = false)
    {
        if ($this->hasDiscount()) {

            if ($getFinal) {
                // return the final price after discount
                return $this->price - round(
                    $this->price * $this->discount / 100
                );
            }

            // just return the discount amount
            return round($this->price * $this->discount / 100);
        }

        return 1;
    }

    /**
     * Allows us to check if a product has a discount
     *
     * @return bool
     */
    public function hasDiscount()
    {
        return !empty($this->discount);
    }

    /**
     * Allows us to check if a product has been reviewed. just a wrapper around the getSingleProductReviewCount function
     *
     * @return bool
     */
    public function hasReviews()
    {
        return $this->getSingleProductReviewCount() > 0;
    }

    /**
     * sorts the product reviews by date, and returns them
     *
     * This is used in the single products page, to render the reviews. We dont need to display all of them,
     * so we grab a variable amount, default = 5
     *
     * @return mixed
     */
    public function grabReviews($howMany = 5)
    {
        return $this->reviews->take($howMany)->sortBy(
            function ($r) {
                $r->created_at;
            }
        );
    }

    /**
     * @return array
     */
    public function allowedCategories()
    {
        return $this->allowed_categories;
    }
}
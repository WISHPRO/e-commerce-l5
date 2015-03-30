<?php namespace App\Antony\DomainLogic\Modules\Product;

use App\Antony\DomainLogic\Modules\ShoppingCart\Formatters\MoneyFormatter;
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

    public function getPrice($format = true)
    {
        if ($format) {
            $formatter = new MoneyFormatter();
            return $formatter->format($this->price);
        }

        return $this->price->getAmount();

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
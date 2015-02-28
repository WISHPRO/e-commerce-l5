<?php namespace app\Anto\Traits;

use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;

trait ProductTrait
{
    // define categories that will display their specifications in the single products page
    protected $allowed_categories
        = [
            'Laptops',
            'desktop systems',
        ];

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
     * Generate a sample product SKU
     *
     * @return string
     */
    public function generateProductSKU()
    {
        return generateRandomInt();
    }

    /**
     * Allows us to calculate the discount of a product, with an option of
     * returning the discount amount, or the final price after subtracting
     * the discount amount. default is to just return the discount amount
     *
     * @param bool $getFinalPrice
     *
     * @return float
     */
    public function calculateDiscount($getFinalPrice = false)
    {
        if ($this->hasDiscount()) {

            if ($getFinalPrice) {
                // return the final price after discount
                return $this->price - round(
                    $this->price * $this->discount / 100
                );
            }

            // just return the discount amount
            return round($this->price * $this->discount / 100);
        }

        return 0;
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
     * Allows us to get the total number of unique reviews for a particular product
     *
     * @return int|null
     */
    public function getSingleProductReviewCount()
    {
        return $this->reviews->unique()->count();
    }

    /**
     * sorts the product reviews by date, and returns them
     *
     * @return mixed
     */
    public function grabReviews()
    {
        return $this->reviews->take(5)->sortBy(
            function ($r) {
                $r->created_at;
            }
        );
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
     * Allow specific product category descriptions to be displayed. eg of a product
     * is a phone, or accessory, we don't need to display the CPU, OS, RAM, etc
     * This function specifies which categories should skip those
     *
     * @return mixed
     */
    public function filterCategories($category_name = [])
    {
        static $count = 0;

        $keys = (empty($category_name)) ? $this->getAllowedCategories()
            : $category_name;

        foreach ($keys as $key) {
            // locate the category names in the product collection
            if (array_search($key, $this->categories->fetch('name')->toArray())
                == 0
            ) {
                // increment find count
                $count++;
            }
        }

        // if this value exceeds 1, then the specific categories will be allowed to display the
        // static computer related specifications like CPU, OS, etc
        return $count;
    }

    /**
     * @return array
     */
    public function allowedCategories()
    {
        return $this->allowed_categories;
    }
}
<?php

// FUNCTIONS FOR dealing with products

use app\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Allows us to determine if a product has ran out of stock
 * @param Product $product
 * @return bool
 */
function hasRanOutOfStock(Product $product)
{
    return empty($product->quantity);
}

/**
 * Allows us to check if a product has a discount
 * @param Model|Product $product
 * @return bool
 */
function hasDiscount(Model $product)
{
    return !empty($product->discount);
}

/**
 * Allows us to calculate the discount of a product, with an option of
 * returning the discount amount, or the final price after subtracting
 * the discount amount. default is to just return the discount amount
 * @param Model|Product $product
 * @param bool $getFinalPrice
 * @return float
 */
function calculateDiscount(Model $product, $getFinalPrice = false)
{
    if(hasDiscount($product)) {

        if($getFinalPrice) {
            // return the final price after discount
            return $product->price - round($product->price * $product->discount / 100);
        }
        // just return the discount amount
        return round($product->price * $product->discount / 100);
    }
    return 0;
}

/**
 * Okay, this attempts to calculate the average rating of a product
 * @param Collection|Product $collection
 * @param string $object_to_access
 * @param $attribute
 * @return float
 */
function getAverageRating(Product $collection, $object_to_access = "reviews", $attribute = "stars")
{
//    {{ array_sum($product->reviews->unique()->fetch('stars')->toArray()) / $product->reviews->count()}}
    // grab the data
    $data = $collection->$object_to_access->unique()->fetch($attribute)->toArray();
    // count all unique reviews
    $review_count = getReviewCount($collection, $object_to_access);
    // avoid division by 0
    if(is_null($review_count)){
        return 0;
    }
    // sum up all review ratings
    $total_reviews = array_sum($data);
    // get average
    return $total_reviews / $review_count;
}

/**
 * Allows us to get the total number of unique reviews for a particular product
 * @param Product $collection
 * @param string $object_to_access
 * @return int|null
 */
function getReviewCount(Product $collection, $object_to_access = "reviews")
{
    $count = $collection->$object_to_access->unique()->count();

    return $count != 0 ? $count : null;
}

/**
 * Allows us to check if a product has been reviewed. just a wrapper around the getReviewCount function
 * @param Product $collection
 * @param string $object_to_access
 * @return bool
 */
function HasReviews(Product $collection, $object_to_access = "reviews")
{
    return getReviewCount($collection, $object_to_access) > 0;
}

/**
 * Allows us to determine if a product is 'hot' ie really rated highly
 * A hot product should have a rating of 4+, and have at least 5 reviews
 * @param Product $collection
 * @param string $object_to_access
 * @param string $attribute
 * @return bool
 */
function productIsHot(Product $collection, $object_to_access = "reviews", $attribute = "stars")
{
    return getAverageRating($collection, $object_to_access, $attribute)
    >= config('site.reviews.hottest') && getReviewCount($collection)
    >= config('site.reviews.count');
}

/**
 * Determines if a product is new
 * @param Product $collection
 * @return bool
 */
function productIsNew(Product $collection)
{
    $byWhen = new Carbon('last friday');

    return $collection->created_at >= $byWhen;
}

/**
 * Generate a sample product SKU, which will:
 * allow users to search for products by SKU number too
 * okay...anyway, don know much about SKU's. We shall improve on this in future
 * @return string
 */
function generateProductSKU()
{
    return generateRandomInt();
}

/**
 * Allow specific product category descriptions to be displayed. eg of a product
 * is a phone, or accessory, we don't need to display the CPU, OS, RAM, etc
 * This function specifies which categories should skip those
 * @param Product $collection
 * @param array $category_name
 * @param string $index
 * @return mixed
 */
function filterCategories(Product $collection, $category_name = [], $index = 'name')
{
    static $count = 0;

    $keys = (empty($category_name)) ? $collection->getAllowedCategories() : $category_name;

    foreach ($keys as $key)
    {
        // locate the category names in the product collection
        if(array_search($key, $collection->categories->fetch($index)->toArray()) == 0)
        {
            // increment find count
            $count ++;
        }
    }

    // if this value exceeds 1, then the specific categories will be allowed to display the
    // static computer related specifications like CPU, OS, etc
    return $count;

    // array_search('Laptops', $product->categories->fetch('name')->toArray())
}
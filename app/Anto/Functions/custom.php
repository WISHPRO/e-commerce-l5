<?php
/* ========================================
    CUSTOM APPLICATION FUNCTIONS
    @antony
   ========================================
*/

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Helper to generate csrf
 * @return string
 */
function generateCSRF()
{
    $csrf = csrf_token();
    return "<input type=\"hidden\" name=\"_token\" value=$csrf >";
}

/**
 * custom url generator function, for the login part. i'll use when i need to
 * I actually wanted sth like /auth/login?returnURL=someUrl, so just copied this from stackoverflow
 * @param null $path
 * @param array $queryString
 * @param bool $secure
 * @return string
 */
function getCustomURL($path = null, $queryString = array(), $secure = true)
{
    $url = app( 'url' )->to( $path , $secure );
    if (count($queryString)) {

        foreach ($queryString as $key => $value) {
            $queryString[$key] = sprintf('%s=%s', $key, urlencode($value));
        }

        $url = sprintf('%s?%s', $url, implode('&', $queryString));
    }
    return $url;
}

/**
 * Allow a client to search for a product by ID or name
 * @param $query
 * @param null $id
 * @param array $sortOptions
 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
 */
function ClientSearch($query, $id = null, $sortOptions = array())
{
    if (!is_null($id)) {

        if ($id > 0) {
            // search by ID. much faster, since its primary key based, and will return an object containing exactly a single product
            $product = Product::with('reviews', 'categories')->find($id);

            // if no results were returned, just display the search index page
            if (empty($product)) {
                return View::make('frontend.search.index')->with('message', 'sorry. we found no products matching an id of '. $id)->with('alertclass', 'alert-info');
            }
            // results were found. display the single products view, passing through the data
            return View::make('frontend.products.single', compact('product'));
        }
        // just let the query flow to the next section

    }

    // search by product name
    $keywords = $query;

    // tried full text, it worked obviously,  but just decided to revert back to normal search
    $products = Product::with('reviews')
        // search by name
        ->where('name', 'LIKE', '%' . $keywords . '%')
        // search by SKU number, assuming the query was an SKU number
        ->orWhere('sku', '=', $keywords)
        // search also by product description to widen query results
        ->orWhere('description', 'LIKE', '%' . $keywords . '%')->paginate(10);

    // waah..no results were found
    if ($products->isEmpty()) {

        return View::make('frontend.search.index')->with('message', 'sorry. we found no products matching ' . $keywords)->with('alertclass', 'alert-info');
    }
    // return the results to the user
    return View::make('frontend.products.index', compact('products'));

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
 * Okay, this attempts to calculate the average rating of a product. still incomplete though...
 * @param Collection|Product $collection
 * @param string $object_to_access
 * @param $attribute
 * @return float
 */
function getAverageRating(Product $collection, $object_to_access = "reviews", $attribute = "stars")
{
//    {{ array_sum($product->reviews->unique()->fetch('stars')->toArray()) / $product->reviews->count()}}
    // grab the data. still working on this
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
 * Allows us to get the total number of unique reviews for a particular product. still incomplete though...
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
    >= env('RATINGS_HOTTEST', 4) && getReviewCount($collection)
    >= env('RATINGS_HOTTEST_REVIEWS', 10);
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
    return mt_rand(100000, 999999);
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
    foreach ($category_name as $key)
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

/**
 * Allows us to generate a cart ID
 * @return string
 */
function generateCartID()
{
    return str_random(10);
}

/**
 * Calculate the subtotal of products in the cart
 * @param Model $cart
 * @return mixed
 */
function getCartSubTotal(Model $cart)
{
    return $cart->products->sum( function($product ){
        // sum em, based on the presence of a discount
        if(hasDiscount($product)){
            return calculateDiscount($product, true);
        }
        else{
            return $product->price;
        }
    });
}
<?php
use app\Models\Product;

/**
 * Allow a client to search for a product by ID or name
 * @param $query
 * @param null $id
 * @param array $sortOptions
 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
 */
function findProduct($query, $id = null, $sortOptions = array())
{
    if (!is_null($id)) {

        if ($id > 0) {
            // search by ID. much faster, since its primary key based, and will return an object containing exactly a single product
            $product = Product::with('reviews', 'categories')->find($id);

            // if no results were returned, just display the search index page
            if (empty($product)) {
                // \Flash::message('sorry. we found no products matching an id of '. $id);
                return view('frontend.search.index');
            }
            // results were found. display the single products view, passing through the data
            return view('frontend.products.single', compact('product'));
        }

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
        ->orWhere('description_long', 'LIKE', '%' . $keywords . '%')->paginate(10);

    // waah..no results were found
    if ($products->isEmpty()) {

        // \Flash::message('sorry. we found no products matching '. $keywords);
        return view('frontend.search.index');
    }
    // return the results to the user
    return view('frontend.products.index', compact('products'));

}
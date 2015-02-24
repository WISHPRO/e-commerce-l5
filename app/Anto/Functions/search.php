<?php
use app\Models\Product;

/**
 * Allow a client to search for a product by ID or name
 *
 * @param       $query
 * @param null  $sku
 * @param array $sortOptions
 *
 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
 */
function findProduct( $query, $sku = null, $sortOptions = [ ] )
{
    if (!is_null( $sku )) {

        if ($sku > 0) {
            // search by product SKU. much faster, since its key based, and will return an object containing exactly a single product
            $products = findBySku( $sku );

            // if no results were returned, just display the search index page
            if (empty( $products ))
            {
                flash()->message('sorry. we found no products matching an SKU of '. $sku);
                return view( 'frontend.search.index' );
            }

            // results were found. display the single products view, passing through the data
            return view( 'frontend.products.index', compact( 'products' ) );
        }

    }

    // search by product name
    $keywords = $query;

    // tried full text, it worked obviously,  but just decided to revert back to normal search
    $products = Product::with( 'reviews' )
        // search by name
        ->where( 'name', 'LIKE', '%' . $keywords . '%' )
        // search also by product description to widen query results
        ->orWhere( 'description_long', 'LIKE', '%' . $keywords . '%' )->paginate( 10 );

    // waah..no results were found
    if ($products->isEmpty())
    {
        flash('sorry. we found no products matching '. $keywords);
        return view( 'frontend.search.index' );
    }

    // return the results to the user
    return view( 'frontend.products.index', compact( 'products' ) );

}

function findBySku( $sku )
{
    return Product::with( 'reviews', 'categories' )->whereSku( $sku )->paginate( 5 );
}
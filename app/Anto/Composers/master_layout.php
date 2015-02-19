<?php
/*
 * our lovely composer that will allow the sidebar,
 * and brands data to be displayed across all pages on the site
 * Data shared across requests is cached for 10 minutes, to reduce database round-trips
*/
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use Carbon\Carbon;

View::composer('layouts.frontend.master', function ($view) {

    // check if the cache has the key 'data'
    if(Cache::has('data') & composerCachingEnabled()){
        // read all data from cache
        $data = Cache::get('data');

        // send the array over to the view
        $view->with('data', $data);

    } else {
        // start with an empty array
        $data = [];

        // fill in the categories + subcategories
        $data['categories'] = Category::with('subcategories')->take(10)->orderBy('name', 'asc')->get();

        // fill in the product brands. for now, just pluck 7 in an ascending order, for simplicity
        $data['brands'] = Brand::with('products')->whereNotNull('logo')->take(7)->orderBy('name', 'asc')->get();

        // store all this in the cache
        Cache::put('data', $data, Carbon::now()->addMinutes(composerCachingDuration()));

    }

    if(cartExists()){
        // fill the cart, if it has any products. This will not be cached for obvious reasons
        $data['cart_items'] = Cart::with('products.carts')->where('id', getCartID())->get();
    }

    // send the array over to the view
    $view->with('data', $data);

});
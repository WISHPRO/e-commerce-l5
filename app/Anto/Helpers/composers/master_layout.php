<?php
/*
 * our lovely composer that will allow the sidebar,
 * and brands data to be displayed across all pages on the site
 * Data shared across requests is cached for 10 minutes, to reduce database round-trips
*/
use Carbon\Carbon;

View::composer('layouts.frontend.master', function ($view) {

    // check if the cache has the key 'data'
    if(Cache::has('data')){
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
        $data['brands'] = Brand::whereNotNull('logo')->take(7)->orderBy('name', 'asc')->get();

        // store all this in the cache
        Cache::put('data', $data, Carbon::now()->addMinutes(10));

    }

    if(!is_null(Cookie::get('shopping_cart'))){
        // fill the cart, if it has any products. This will not be cached for obvious reasons
        $data['cart_items'] = Cart::with('products')->where('id', Cookie::get('shopping_cart'))->get();
    }

    // send the array over to the view
    $view->with('data', $data);

});
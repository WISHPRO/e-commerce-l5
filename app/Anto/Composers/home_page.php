<?php

use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;

// same as above, but this composer will only operate on the index page
View::composer('frontend.index', function ($view) {

    if(Cache::has('ads')){
        $ads = Cache::get('ads');

        // send the array over to the view
        $view->with('ads', $ads);

    } else {

        $ads = [];

        // display top rated products. okay,
        /* First, this will retrieve a product more than once,
        of course since it was reviewed more than once
        second, this isn't accurate since even a product reviewed
        even once and given a high rating will be fetched
        I'll try to sort this issues out when we iterate over the data
        */
        $data = Product::with(['reviews' => function($query)
        {
            $query->where('stars', '>=', '4');

        }])->get();

        //dd($data);
        // sort the collection
        $data = $data->sortBy(function ($data) {
            return $data->stars;
        });

        // add the data collection to the array
        $ads['top-rated'] = $data;

        // display new products. This is gonna be easy
        $ads['new-products'] = Product::where('created_at', '>=', new Carbon('last friday'))->get();

        // display top sold products...still to be implemented

        // store all this in the cache
        Cache::put('ads', $ads, Carbon::now()->addMinutes(10));

        // send the array over to the view
        $view->with('ads', $ads);
    }
});

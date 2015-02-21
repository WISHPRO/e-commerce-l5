<?php

use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;

// same as above, but this composer will only operate on the index page
View::composer(
    'frontend.index',
    function ( $view ) {

        if (Cache::has( 'ads' ) & composerCachingEnabled()) {
            $ads = Cache::get( 'ads' );

            // send the cached data over to the view
            $view->with( 'ads', $ads );

        } else {

            $ads = [ ];

            // display top rated products. okay
            $data = Product::with(
                [
                    'reviews' => function ( $query ) {
                        $query->where( 'stars', '>=', '4' )->orderBy( 'stars', 'asc' );

                    }
                ]
            )->get()->take( 10 );

            //dd($data);
            // add the data collection to the array
            $ads[ 'top-rated' ] = $data;

            // display new products. This is gonna be easy
            $ads[ 'new-products' ] = Product::where( 'created_at', '>=', new Carbon( 'last friday' ) )->get()->take(
                10
            );

            // display top sold products...still to be implemented

            // store all this in the cache
            Cache::put( 'ads', $ads, Carbon::now()->addMinutes( composerCachingDuration() ) );

            // send the array over to the view
            $view->with( 'ads', $ads );
        }
    }
);

<?php

/*=========================================
    DEFAULT ROUTE,
    ie the root of our lovely site /
 ==========================================
*/

Route::get( '/', [ 'as' => 'home', 'uses' => 'Frontend\HomeController@index', 'middleware' => [ 'no-ssl' ] ] );
Route::get( '/home', [ 'as' => 'home', 'uses' => 'Frontend\HomeController@index', 'middleware' => [ 'no-ssl' ] ] );

/*=========================================
    USER HELP
 ==========================================
*/
Route::group(
    [ 'prefix' => 'help', 'middleware' => [ 'no-ssl' ] ],
    function () {
        /*
         * general site help. i'll try to be as precise and simplistic as possible in explaining this stuff
         * */
        Route::group(
            [ 'prefix' => '' ],
            function () {

            }
        );
    }
);

/*=========================================
    INFORMATION PAGES SECTION
 ==========================================
*/
Route::group(
    [ 'prefix' => 'info', 'middleware' => [ 'no-ssl' ] ],
    function () {

        // requesting the about page
        Route::get( 'about', [ 'as' => 'about', 'uses' => 'Frontend\InfoController@about' ] );
        // requesting the terms & conditions page
        Route::get( 'terms', [ 'as' => 'terms', 'uses' => 'Frontend\InfoController@terms' ] );
        // requesting the contact page
        Route::get( 'contact', [ 'as' => 'contact', 'uses' => 'Frontend\InfoController@contact' ] );
        // this will handle the action of a user sending a message to us. since the form is already by default on the page, we don't need a GET request
        Route::post( 'contact', [ 'as' => 'contact.post', 'uses' => 'Frontend\InfoController@store' ] );
    }
);

/*=========================================
    SITE AUTHENTICATION
  =========================================
*/

Route::group(
    [ 'prefix' => 'account', 'middleware' => [ 'force-ssl' ] ],
    function () {
        // requesting the login page
        Route::get( 'login', [ 'as' => 'login', 'uses' => 'Auth\AuthController@getLogin' ] );
        // posting to the login page, for credentials validation
        Route::post( 'login', [ 'as' => 'login.verify', 'uses' => 'Auth\AuthController@postLogin' ] );
        Route::get( 'logout', [ 'as' => 'logout', 'uses' => 'Auth\AuthController@getLogout' ] );
        /*
         * User registration
         * */
        Route::get( 'register', [ 'as' => 'register', 'uses' => 'Auth\AuthController@getRegister' ] );
        Route::post( 'register', [ 'as' => 'registration.store', 'uses' => 'Auth\AuthController@postRegister' ] );

        // allowing a non-looged in user to reset their password. This will allow them to enter their email
        // and recieve a token which we shall then verify below
        Route::group(
            [ 'prefix' => 'resetpassword' ],
            function () {

                Route::get( '/', [ 'as' => 'password.reset', 'uses' => 'Auth\PasswordController@getEmail' ] );
                Route::post( '/', [ 'as' => 'reset.postEmail', 'uses' => 'Auth\PasswordController@postEmail' ] );

                // http://localhost:8000/account/password/requestNewPassword?token=a54f44f334e503055dfe3a1b10ea6a705e05123a
                // process a reset password request
                Route::get(
                    '/requestNew',
                    [ 'as' => 'reset.start', 'uses' => 'Auth\PasswordController@getReset' ]
                );
                Route::post(
                    '/saveNew',
                    [ 'as' => 'reset.finish', 'uses' => 'Auth\PasswordController@postReset' ]
                );
            }
        );

    }
);

/*=========================================
    USER'S ACCOUNT
  =========================================
*/

Route::group(
    [ 'prefix' => "myaccount", 'middleware' => [ 'auth', 'force-ssl' ] ],
    function () {
        // requesting to logout


        // account customizations
        Route::get( '/', [ 'as' => 'myaccount', 'uses' => 'Frontend\UsersController@index' ] );
        Route::put( '/edit', [ 'as' => 'myaccount.edit', 'uses' => 'Frontend\UsersController@update' ] );
        Route::delete( '/delete', [ 'as' => 'myaccount.delete', 'uses' => 'Frontend\UsersController@destroy' ] );

        // a logged in user should be able to reset their password too. The url might change, but the reference controller doesn't
        Route::get(
            '/reset_password',
            [ 'as' => 'my_account.password.reset', 'uses' => 'Frontend\AuthController@resetPassword' ]
        );

        Route::get( '/cart', [ 'as' => 'my_cart', 'uses' => 'Frontend\CartController@history' ] );
        Route::get( '/orders', [ 'as' => 'my_orders', 'uses' => 'Frontend\OrdersController@orders' ] );
        Route::get( '/order-history', [ 'as' => 'my_order_trail', 'uses' => 'Frontend\OrdersController@history' ] );

    }
);

/* ========================================
    PRODUCTS
   ========================================
*/

Route::group(
    [ 'prefix' => 'products', 'middleware' => [ 'no-ssl' ] ],
    function () {
        // this will handle user requests to view a specific product
        // such requests expecting an id & name should come from search, categories view page, etc
        Route::get( '{id}/', [ 'as' => 'product.view', 'uses' => 'Frontend\ProductsController@show' ] );
        // display all products, regardless of category, subcategory, etc. this shall be removed in future
        Route::get( '/', [ 'as' => 'allproducts', 'uses' => 'Frontend\ProductsController@index' ] );
        // email a product
        Route::get( '/{id}/email', [ 'as' => 'products.email', 'uses' => 'Frontend\ProductsController@email' ] );
    }
);

/* ========================================
    CATEGORIES
   ========================================
*/

Route::group(
    [ 'prefix' => 'categories', 'middleware' => [ 'no-ssl' ] ],
    function () {
        // listing categories. sort of sitemaping, or whatever
        Route::get( '/all', [ 'as' => 'f.categories.display', 'uses' => 'Frontend\CategoriesController@index' ] );

        // display all products in the category, regardless of sub-category
        Route::get( '/{id}', [ 'as' => 'f.categories.view', 'uses' => 'Frontend\CategoriesController@show' ] );
    }
);

/* ========================================
    SUB-CATEGORIES
   ========================================
*/

Route::group(
    [ 'prefix' => 'sub-categories', 'middleware' => [ 'no-ssl' ] ],
    function () {
        // this will handle requests straight from the sidebar. Expects a subcategoryID
        Route::get( '/{id}', [ 'as' => 'f.subcategories.view', 'uses' => 'Frontend\SubCategoriesController@show' ] );
    }
);

/* ========================================
    SHOP BY BRANDS
   ========================================
*/

Route::group(
    [ 'prefix' => 'brands', 'middleware' => [ 'no-ssl' ] ],
    function () {

        Route::get( '/{id}/products', [ 'as' => 'brands.shop', 'uses' => 'Frontend\BrandsController@show' ] );
    }
);

/* ========================================
    SEARCHING, ON THE CLIENT SIDE
   ========================================
*/

Route::group(
    [ 'prefix' => 'search', 'middleware' => [ 'no-ssl' ] ],
    function () {
        // handles a search request from the client
        Route::get( '/', [ 'as' => 'client.search', 'uses' => 'Frontend\SearchController@show' ] );
    }
);

/* ========================================
    WISH LISTS
   ========================================
*/
// the wishlist landing page
Route::get(
    '/wishlist',
    [ 'as' => 'wishlist', 'uses' => 'Frontend\WishlistsController@index', 'middleware' => [ 'no-ssl' ] ]
);

Route::group(
    [ 'prefix' => 'wishlist', 'middleware' => [ 'auth', 'force-ssl' ] ],
    function () {
        // creating a new wishlist
        Route::get( '/create', [ 'as' => 'mywishlist.create', 'uses' => 'Frontend\WishlistsController@create' ] );
        // adding a product to the wishlist
        Route::post( 'add_product/{id}', [ 'as' => 'mywishlist.add', 'uses' => 'Frontend\WishlistsController@add' ] );
        //listing all the authenticated user's wishlists
        Route::get( '/view', [ 'as' => 'mywishlist', 'uses' => 'Frontend\WishlistsController@view' ] );
        // viewing a particular wishlist
        Route::get( '/{id}/show', [ 'as' => 'mywishlist.view', 'uses' => 'Frontend\WishlistsController@show' ] );
        // removing a product from the wishlist
        Route::delete(
            'remove_product/{id}',
            [ 'as' => 'mywishlist.update', 'uses' => 'Frontend\WishlistsController@edit' ]
        );
    }
);

/* ========================================
    SHOPPING CART
   ========================================
*/

Route::group(
    [ 'prefix' => 'cart' ],
    function () {
        // adding a product to the cart
        Route::post( 'add_product/{id}', [ 'as' => 'cart.add', 'uses' => 'Frontend\CartController@store' ] );
        // listing all products in the cart
        Route::get( '/view_products', [ 'as' => 'cart.view', 'uses' => 'Frontend\CartController@view' ] );
        // add a product to an existing cart
        Route::put( '/update/add_product/{id}', [ 'as' => 'cart.update', 'uses' => 'Frontend\CartController@update' ] );
        // removing a product from an existing cart
        Route::put(
            '/update/remove_product/{id}',
            [ 'as' => 'cart.update.remove', 'uses' => 'Frontend\CartController@removeProduct' ]
        );
    }
);

/* ========================================
    CHECKING OUT
   ========================================
*/

Route::group(
    [ 'prefix' => 'checkout', 'middleware' => [ 'auth', 'force-ssl' ] ],
    function () {
        // initial checkout page, which displays the checkout form
        Route::get( '/begin_checkout', [ 'as' => 'checkout.start', 'uses' => 'Frontend\CheckoutController@process' ] );
        // checkout steps
        Route::post(
            '/checkout_steps/{id}',
            [ 'as' => 'checkout.steps', 'uses' => 'Frontend\CheckoutController@processSteps' ]
        );
    }
);

// product reviews test
Route::group(
    [ 'prefix' => 'reviews', 'middleware' => [ 'auth', 'force-ssl' ] ],
    function () {

        Route::get( 'product/{id}/save', [ 'as' => 'reviews.post', 'uses' => 'ReviewsController@index' ] );
    }
);
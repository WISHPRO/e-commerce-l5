<?php
// home page
get(
    '/',
    [
        'as'         => 'home',
        'uses'       => 'Frontend\HomeController@index',
        'middleware' => ['http']
    ]
);

/*=========================================
    USER HELP
 ==========================================
*/
Route::group(
    ['prefix' => 'help', 'middleware' => ['http']],
    function () {
        /*
         * general site help. i'll try to be as precise and simplistic as possible in explaining this stuff
         * */
        Route::group(
            ['prefix' => ''],
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
    ['prefix' => 'info', 'middleware' => ['http']],
    function () {

        // requesting the about page
        get(
            'about',
            ['as' => 'about', 'uses' => 'Frontend\InfoController@about']
        );
        // requesting the terms & conditions page
        get(
            'terms',
            ['as' => 'terms', 'uses' => 'Frontend\InfoController@terms']
        );
        // requesting the contact page
        get(
            'contact',
            ['as' => 'contact', 'uses' => 'Frontend\InfoController@contact']
        );
        // this will handle the action of a user sending a message to us. since the form is already by default on the page, we don't need a GET request
        post(
            'contact',
            ['as' => 'contact.post', 'uses' => 'Frontend\InfoController@store']
        );
    }
);

/*=========================================
    SITE AUTHENTICATION
  =========================================
*/

Route::group(
    ['prefix' => 'account', 'middleware' => ['https']],
    function () {
        // requesting the login page
        get(
            'login',
            ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']
        );
        // posting to the login page, for credentials validation
        post(
            'login',
            ['as' => 'login.verify', 'uses' => 'Auth\AuthController@postLogin']
        );
        get(
            'logout',
            ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']
        );
        /*
         * User registration
         * */
        get(
            'register',
            ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']
        );
        post(
            'register',
            [
                'as'   => 'registration.store',
                'uses' => 'Auth\AuthController@postRegister'
            ]
        );

        // allowing a non-looged in user to reset their password. This will allow them to enter their email
        // and recieve a token which we shall then verify below
        Route::group(
            ['prefix' => 'password'],
            function () {

                get(
                    '/reset',
                    [
                        'as'   => 'password.reset',
                        'uses' => 'Auth\PasswordController@getEmail'
                    ]
                );
                post(
                    '/reset',
                    [
                        'as'   => 'reset.postEmail',
                        'uses' => 'Auth\PasswordController@postEmail'
                    ]
                );

                // http://localhost:8000/account/password/requestNewPassword?token=a54f44f334e503055dfe3a1b10ea6a705e05123a
                // process a reset password request
                get(
                    '/new',
                    [
                        'as'   => 'reset.start',
                        'uses' => 'Auth\PasswordController@getReset'
                    ]
                );
                post(
                    '/new',
                    [
                        'as'   => 'reset.finish',
                        'uses' => 'Auth\PasswordController@postReset'
                    ]
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
    ['prefix' => "myaccount", 'middleware' => ['auth', 'https']],
    function () {

        // account customizations
        get(
            '/',
            ['as' => 'myaccount', 'uses' => 'Frontend\UsersController@index']
        );
        put(
            '/edit',
            [
                'as'   => 'myaccount.edit',
                'uses' => 'Frontend\UsersController@update'
            ]
        );
        delete(
            '/delete',
            [
                'as'   => 'myaccount.delete',
                'uses' => 'Frontend\UsersController@destroy'
            ]
        );

        // a logged in user should be able to reset their password too. The url might change, but the reference controller doesn't
        get(
            '/password/new',
            [
                'as'   => 'my.password.new',
                'uses' => 'Auth\PasswordController@resetPassword'
            ]
        );

        post(
            '/password/new',
            [
                'as'   => 'my.password.save',
                'uses' => 'Auth\PasswordController@postResetPassword'
            ]
        );

        get(
            '/cart',
            ['as' => 'mycart', 'uses' => 'Frontend\CartController@history']
        );
        get(
            '/orders',
            ['as' => 'myorders', 'uses' => 'Frontend\OrdersController@orders']
        );
        get(
            '/orders/history',
            [
                'as'   => 'myorder-history',
                'uses' => 'Frontend\OrdersController@history'
            ]
        );

    }
);

/* ========================================
    PRODUCTS
   ========================================
*/

Route::group(
    ['prefix' => 'products', 'middleware' => ['http']],
    function () {
        // this will handle user requests to view a specific product
        // such requests expecting an id & name should come from search, categories view page, etc
        get(
            '{id}/',
            [
                'as'   => 'product.view',
                'uses' => 'Frontend\ProductsController@show'
            ]
        );
        // display all products, regardless of category, subcategory, etc. this shall be removed in future
        get(
            '/',
            [
                'as'   => 'allproducts',
                'uses' => 'Frontend\ProductsController@index'
            ]
        );
        // email a product
        get(
            '/{id}/email',
            [
                'as'   => 'products.email',
                'uses' => 'Frontend\ProductsController@email'
            ]
        );
    }
);

/* ========================================
    CATEGORIES
   ========================================
*/

Route::group(
    ['prefix' => 'categories', 'middleware' => ['http']],
    function () {
        // listing categories. sort of sitemaping, or whatever
        get(
            '/all',
            [
                'as'   => 'f.categories.display',
                'uses' => 'Frontend\CategoriesController@index'
            ]
        );

        // display all products in the category, regardless of sub-category
        get(
            '/{id}',
            [
                'as'   => 'f.categories.view',
                'uses' => 'Frontend\CategoriesController@show'
            ]
        );
    }
);

/* ========================================
    SUB-CATEGORIES
   ========================================
*/

Route::group(
    ['prefix' => 'sub-categories', 'middleware' => ['http']],
    function () {
        // this will handle requests straight from the sidebar. Expects a subcategoryID
        get(
            '/{id}',
            [
                'as'   => 'f.subcategories.view',
                'uses' => 'Frontend\SubCategoriesController@show'
            ]
        );
    }
);

/* ========================================
    SHOP BY BRANDS
   ========================================
*/

Route::group(
    ['prefix' => 'brands', 'middleware' => ['http']],
    function () {

        get(
            '/{id}',
            ['as' => 'brands.shop', 'uses' => 'Frontend\BrandsController@show']
        );
    }
);

/* ========================================
    SEARCHING, ON THE CLIENT SIDE
   ========================================
*/

Route::group(
    ['prefix' => 'search', 'middleware' => ['http']],
    function () {
        // handles a search request from the client
        get(
            '/',
            [
                'as'   => 'client.search',
                'uses' => 'Frontend\SearchController@show'
            ]
        );
    }
);

/* ========================================
    WISH LISTS
   ========================================
*/
// the wishlist landing page
get(
    '/wishlist',
    [
        'as'         => 'wishlist',
        'uses'       => 'Frontend\WishlistsController@index',
        'middleware' => ['http']
    ]
);


resource('wishlist', 'Frontend\WishlistsController', ['middleware' => 'auth']);
// manipulating products in a wishlist
resource('products', 'Frontend\ProductWishlistsController', ['middleware' => ['auth, https']]);


/* ========================================
    SHOPPING CART
   ========================================
*/

Route::group(
    ['prefix' => 'cart/products'],
    function () {
        get(
            '/',
            ['as' => 'cart.index', 'uses' => 'Frontend\CartController@index']
        );
        // adding a product to the cart
        post(
            'add/{id}',
            ['as' => 'cart.add', 'uses' => 'Frontend\CartController@store']
        );
        // listing all products in the cart
        get(
            '/view',
            ['as' => 'cart.view', 'uses' => 'Frontend\CartController@view']
        );
        // add a product to an existing cart
        patch(
            '/update/{id}',
            ['as' => 'cart.update', 'uses' => 'Frontend\CartController@update']
        );

        delete(
            '/update/{id}/remove',
            [
                'as'   => 'cart.update.remove',
                'uses' => 'Frontend\CartController@removeProduct'
            ]
        );
    }
);

/* ========================================
    REVIEWING A PRODUCT
   ========================================
*/
Route::resource(
    'product.reviews',
    'Frontend\ReviewsController'
);

/* ========================================
    CHECKING OUT
   ========================================
*/

Route::group(
    ['prefix' => 'checkout', 'middleware' => ['auth', 'https']],
    function () {
        // initial checkout page, which displays the checkout form
        get(
            '/begin',
            [
                'as'   => 'checkout.start',
                'uses' => 'Frontend\CheckoutController@index'
            ]
        );
        // checkout steps
        post(
            '/steps/{id}',
            [
                'as'   => 'checkout.steps',
                'uses' => 'Frontend\CheckoutController@processSteps'
            ]
        );
    }
);
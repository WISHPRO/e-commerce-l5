<?php
// home page
get('/', ['as' => 'home', 'uses' => 'Frontend\HomeController@index', 'middleware' => ['http']]);

/*=========================================
    USER HELP
 ==========================================
*/
Route::group(['prefix' => 'help', 'middleware' => ['http']], function () {
    /*
     * general site help. i'll try to be as precise and simplistic as possible in explaining this stuff
     * */
    Route::group(['prefix' => ''], function () {

    });
});

/*=========================================
    INFORMATION PAGES SECTION
 ==========================================
*/
Route::group(['prefix' => 'info', 'middleware' => ['http']], function () {

    // requesting the about page
    get('about', ['as' => 'about', 'uses' => 'Frontend\InfoController@about']);

    // requesting the terms & conditions page
    get('terms', ['as' => 'terms', 'uses' => 'Frontend\InfoController@terms']);

    // requesting the contact page
    get('contact', ['as' => 'contact', 'uses' => 'Frontend\InfoController@contact']);

    // this will handle the action of a user sending a message to us. since the form is already by default on the page, we don't need a GET request
    post('contact', ['as' => 'contact.post', 'uses' => 'Frontend\InfoController@store']);
}
);

/*=========================================
    SITE AUTHENTICATION
  =========================================
*/

Route::group(['prefix' => 'account', 'middleware' => ['https']], function () {

    // requesting the login page
    get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);

    // posting to the login page, for credentials validation
    post('login', ['as' => 'login.verify', 'uses' => 'Auth\AuthController@postLogin']);

    // logout
    get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

    // display registration form
    get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);

    // process user registration
    post('register', ['as' => 'registration.store', 'uses' => 'Auth\AuthController@postRegister']);

    // account activation
    get('/activate/{code}', ['as' => 'account.activate', 'uses' => 'Auth\AuthController@getActivate']);

    // allowing a non-logged in user to reset their password
    Route::group(['prefix' => 'password'], function () {

        // display email form for password reset. This isn't used entirely because displaying the form is done via a modal
        get('/reset', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@getEmail']);

        // verifying email
        post('/reset', ['as' => 'reset.postEmail', 'uses' => 'Auth\PasswordController@postEmail']);

        // display the form for resetting a password
        get('/new', ['as' => 'reset.start', 'uses' => 'Auth\PasswordController@getReset']);

        // save the new password
        post('/new', ['as' => 'reset.finish', 'uses' => 'Auth\PasswordController@postReset']);
    });

});

/*=========================================
    USER'S ACCOUNT
  =========================================
*/

Route::group(['prefix' => "myaccount", 'middleware' => ['auth', 'https']], function () {

    // account customizations
    get('/', ['as' => 'myaccount', 'uses' => 'Frontend\AccountController@index']);

    put('/edit', ['as' => 'myaccount.edit', 'uses' => 'Frontend\AccountController@update']);

    delete('/delete', ['as' => 'myaccount.delete', 'uses' => 'Frontend\AccountController@destroy']);

    patch('/Info/contact', ['as' => 'account.info.contact.edit', 'uses' => 'Frontend\AccountController@contact']);

    patch('/Info/personal', ['as' => 'account.info.personal.edit', 'uses' => 'Frontend\AccountController@personal']);

    patch('/Info/shipping', ['as' => 'account.info.shipping.edit', 'uses' => 'Frontend\AccountController@shipping']);

    patch('/password/new', ['as' => 'account.password.edit', 'uses' => 'Frontend\AccountController@password']);

    get('/delete', ['as' => 'account.delete', 'uses' => 'Frontend\AccountController@delete']);

    delete('/delete', ['as' => 'account.delete.permanent', 'uses' => 'Frontend\AccountController@delete']);

    get('/cart', ['as' => 'mycart', 'uses' => 'Frontend\CartController@history']);

    get('/orders', ['as' => 'myorders', 'uses' => 'Frontend\OrdersController@orders']);

    get('/orders/history', ['as' => 'myorder-history', 'uses' => 'Frontend\OrdersController@history']);

});

/* ========================================
    PRODUCTS
   ========================================
*/

Route::group(['prefix' => 'products', 'middleware' => ['http']], function () {

    /* ========================================
    CATEGORIES
   ========================================
    */

    Route::group(['prefix' => 'categories'], function () {
        // listing categories. sort of sitemaping, or whatever
        get('/all', ['as' => 'f.categories.display', 'uses' => 'Frontend\CategoriesController@index']);

        // display all products in the category, regardless of sub-category
        get('/{id}/{name}', ['as' => 'f.categories.view', 'uses' => 'Frontend\CategoriesController@show']);
    });

    /* ========================================
        SUB-CATEGORIES
       ========================================
    */

    Route::group(['prefix' => 'sub-categories'], function () {
        // this will handle requests straight from the sidebar. Expects a subcategoryID
        get('/{id}/{name}', ['as' => 'f.subcategories.view', 'uses' => 'Frontend\SubCategoriesController@show']);
    });

    // this will handle user requests to view a specific product
    // such requests expecting an id & name should come from search, categories view page, etc
    get('{id}/{name}', ['as' => 'product.view', 'uses' => 'Frontend\ProductsController@show']);

    // display all products, regardless of category, subcategory, etc. this shall be removed in future
    get('/', ['as' => 'allproducts', 'uses' => 'Frontend\ProductsController@index']);

    // email a product
    post('/{id}/email', ['as' => 'products.email', 'uses' => 'Frontend\ProductsController@email']);
}
);

/* ========================================
    SHOP BY BRANDS
   ========================================
*/

Route::group(['prefix' => 'brands', 'middleware' => ['http']], function () {
    get('/{id}/{name}', ['as' => 'brands.shop', 'uses' => 'Frontend\BrandsController@show']);
});

/* ========================================
    SEARCHING, ON THE CLIENT SIDE
   ========================================
*/

Route::group(['prefix' => 'search', 'middleware' => ['http']], function () {
    // handles a search request from the client
    get('/', ['as' => 'client.search', 'uses' => 'Frontend\SearchController@show']);
});

/* ========================================
    WISH LISTS
   ========================================
*/
// the wishlist landing page
get('/wishlist', ['as' => 'wishlist', 'uses' => 'Frontend\WishlistsController@index', 'middleware' => ['http']]);


resource('wishlist', 'Frontend\WishlistsController', ['middleware' => 'auth']);
// manipulating products in a wishlist
resource('products', 'Frontend\ProductWishlistsController', ['middleware' => ['auth, https']]);


/* ========================================
    SHOPPING CART
   ========================================
*/

Route::group(['prefix' => 'cart/products'], function () {
    get('/', ['as' => 'cart.index', 'uses' => 'Frontend\CartController@index']);
    // adding a product to the cart
    post('add/{id}', ['as' => 'cart.add', 'uses' => 'Frontend\CartController@store']);
    // listing all products in the cart
    get('/view', ['as' => 'cart.view', 'uses' => 'Frontend\CartController@view']);
    // add a product to an existing cart
    patch('/update/{id}', ['as' => 'cart.update', 'uses' => 'Frontend\CartController@update']);

    delete('/update/{id}/remove', ['as' => 'cart.update.remove', 'uses' => 'Frontend\CartController@removeProduct']);
}
);

/* ========================================
    REVIEWING A PRODUCT
   ========================================
*/
resource('product.reviews', 'Frontend\ReviewsController');

/* ========================================
    CHECKING OUT
   ========================================
*/
get('checkout/auth', ['as' => 'checkout.auth', 'uses' => 'Frontend\CheckoutController@auth', 'middleware' => ['https']]);

Route::group(['prefix' => 'checkout', 'middleware' => ['https', 'auth.checkout', 'cart.check']], function () {

    get('/begin', ['as' => 'checkout.step1', 'uses' => 'Frontend\CheckoutController@guestInfo']);

    post('/guest', ['as' => 'checkout.step1.store', 'uses' => 'Frontend\CheckoutController@postGuestInfo']);

    patch('/guest', ['as' => 'checkout.step1.edit', 'uses' => 'Frontend\CheckoutController@editShippingAddress']);

    get('/shipping', ['as' => 'checkout.step2', 'uses' => 'Frontend\CheckoutController@shipping']);

    get('/payment', ['as' => 'checkout.step3', 'uses' => 'Frontend\CheckoutController@payment']);

    get('/reviewOrder', ['as' => 'checkout.step4', 'uses' => 'Frontend\CheckoutController@reviewOrder']);
});
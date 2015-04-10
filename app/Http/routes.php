<?php
// home page
get('/', ['as' => 'home', 'uses' => 'Frontend\HomeController@index', 'middleware' => ['http']]);

/*=========================================
    INFORMATION PAGES SECTION
 ==========================================
*/
Route::group(['prefix' => 'information', 'middleware' => ['http']], function () {

    // requesting the about page
    get('about', ['as' => 'about', 'uses' => 'Frontend\InfoController@getAbout']);

    // requesting the terms & conditions page
    get('termsofuse', ['as' => 'terms', 'uses' => 'Frontend\InfoController@getTerms']);

    // requesting the contact page
    get('contact', ['as' => 'contact', 'uses' => 'Frontend\InfoController@getContact']);

    // this will handle the action of a user sending a message to us. since the form is already by default on the page, we don't need a GET request
    post('contact', ['as' => 'contact.post', 'uses' => 'Frontend\InfoController@postContactMessage']);
});

/*=========================================
    SITE AUTHENTICATION
  =========================================
*/

Route::group(['prefix' => 'account', 'middleware' => ['https']], function () {


    Route::group(['prefix' => 'login'], function () {

        // requesting the login page
        get('/', ['as' => 'login', 'uses' => 'Shared\AuthController@getLogin']);

        // posting to the login page, for credentials validation
        post('/', ['as' => 'login.verify', 'uses' => 'Shared\AuthController@postLogin']);

        // API login
        get('/oauth2', ['as' => 'auth.loginUsingAPI', 'uses' => 'Shared\AuthController@apiLogin']);
    });


    Route::group(['prefix' => 'register'], function () {
        // display registration form
        get('/', ['as' => 'register', 'uses' => 'Shared\AuthController@getRegister']);

        // process user registration
        post('/', ['as' => 'registration.store', 'uses' => 'Shared\AuthController@postRegister']);

        // API registration
        get('/oauth2', ['as' => 'auth.registerUsingAPI', 'uses' => 'Shared\AuthController@apiRegistration']);
    });

    // logout
    get('logout', ['as' => 'logout', 'uses' => 'Shared\AuthController@getLogout']);

    // account activation
    get('/activate/{code}', ['as' => 'account.activate', 'uses' => 'Shared\AuthController@getActivate']);

    // allowing a non-logged in user to reset their password
    Route::group(['prefix' => 'password'], function () {

        // display email form for password reset. This isn't used entirely because displaying the form is done via a modal
        get('/reset', ['as' => 'password.reset', 'uses' => 'Shared\PasswordController@getEmail']);

        // verifying email
        post('/reset', ['as' => 'reset.postEmail', 'uses' => 'Shared\PasswordController@postEmail']);

        // display the form for resetting a password
        get('/new/{token}', ['as' => 'reset.start', 'uses' => 'Shared\PasswordController@getReset']);

        // save the new password
        post('/new', ['as' => 'reset.finish', 'uses' => 'Shared\PasswordController@postReset']);
    });


});

/*=========================================
    USER'S ACCOUNT
  =========================================
*/

Route::group(['prefix' => "myaccount", 'middleware' => ['auth', 'https']], function () {

    // account customizations
    get('/', ['as' => 'myaccount', 'uses' => 'Shared\AccountController@index']);

    patch('/Info/contact', ['as' => 'account.info.contact.edit', 'uses' => 'Shared\AccountController@patchContacts']);

    patch('/Info/add', ['as' => 'account.info.addMore', 'uses' => 'Shared\AccountController@patchAccountAddingMoreDetails']);

    patch('/Info/personal', ['as' => 'account.info.personal.edit', 'uses' => 'Shared\AccountController@patchAccount']);

    patch('/Info/shipping', ['as' => 'account.info.shipping.edit', 'uses' => 'Shared\AccountController@patchShipping']);

    patch('/password/new', ['as' => 'account.password.edit', 'uses' => 'Shared\AccountController@patchPassword']);

    get('/delete', ['as' => 'account.delete', 'uses' => 'Shared\AccountController@getDelete']);

    delete('/delete', ['as' => 'account.delete', 'uses' => 'Shared\AccountController@deleteAccount']);

    delete('/destroy', ['as' => 'account.delete.permanent', 'uses' => 'Shared\AccountController@destroy']);

    get('/cart', ['as' => 'mycart', 'uses' => 'Frontend\CartController@history']);

    get('/orders', ['as' => 'myorders', 'uses' => 'Frontend\OrdersController@orders']);

    get('/orders/history', ['as' => 'myorder-history', 'uses' => 'Frontend\OrdersController@history']);
});

// ads

Route::group(['prefix' => 'advertisements'], function () {

    get('{advert}/', ['as' => 'ads.product', 'uses' => 'Frontend\AdvertisementsController@show']);
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
});

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

Route::group(['prefix' => 'search'], function () {
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
Route::group(['prefix' => 'reviews', 'middleware' => ['auth']], function () {

    post('/save/product/{productID}', ['as' => 'product.reviews.store', 'uses' => 'Frontend\ReviewsController@store', 'middleware' => 'reviews.check']);

    patch('/edit/{id}', ['as' => 'product.reviews.update', 'uses' => 'Frontend\ReviewsController@update']);
});

/* ========================================
    CHECKING OUT
   ========================================
*/
get('checkout/auth', ['as' => 'checkout.auth', 'uses' => 'Frontend\GuestCheckoutController@auth', 'middleware' => ['https']]);

Route::group(['prefix' => 'checkout', 'middleware' => ['https', 'auth.checkout', 'cart.check']], function () {

    // checking out as a guest user
    Route::group(['prefix' => 'guest', 'middleware' => ['verify.checkout.guest']], function () {

        get('/begin', ['as' => 'checkout.step1', 'uses' => 'Frontend\GuestCheckoutController@guestInfo']);

        post('/guest', ['as' => 'checkout.step1.store', 'uses' => 'Frontend\GuestCheckoutController@postGuestInfo']);

        patch('/guest', ['as' => 'checkout.step1.edit', 'uses' => 'Frontend\GuestCheckoutController@editShippingAddress']);

        get('/shipping', ['as' => 'checkout.step2', 'uses' => 'Frontend\GuestCheckoutController@shipping']);

        patch('/shipping', ['as' => 'checkout.step2', 'uses' => 'Frontend\GuestCheckoutController@patchShipping']);

        get('/payment', ['as' => 'checkout.step3', 'uses' => 'Frontend\GuestCheckoutController@payment']);

        get('/reviewOrder', ['as' => 'checkout.step4', 'uses' => 'Frontend\GuestCheckoutController@reviewOrder']);
    });

    // checking out as a normal authenticated user
    Route::group(['prefix' => 'user', 'middleware' => ['verify.checkout.user']], function () {

        get('/shipping', ['as' => 'u.checkout.step2', 'uses' => 'Frontend\AuthUserCheckoutController@shipping']);

        patch('/shipping', ['as' => 'u.checkout.step2', 'uses' => 'Frontend\AuthUserCheckoutController@shipping']);

        get('/payment', ['as' => 'u.checkout.step3', 'uses' => 'Frontend\AuthUserCheckoutController@payment']);

        post('/payment', ['as' => 'u.checkout.step3', 'uses' => 'Frontend\AuthUserCheckoutController@payment']);

        get('/reviewOrder', ['as' => 'u.checkout.step4', 'uses' => 'Frontend\AuthUserCheckoutController@reviewOrder']);
    });
});
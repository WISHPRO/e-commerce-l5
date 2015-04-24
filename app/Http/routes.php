<?php
// home page
get('/', ['as' => 'home', 'uses' => 'Frontend\HomeController@index', 'middleware' => ['http']]);

// info pages
Route::group(['middleware' => ['http']], function () {

    // requesting the about page
    get('about', ['as' => 'about', 'uses' => 'Frontend\InfoController@getAbout']);

    // requesting the terms & conditions page
    get('termsofuse', ['as' => 'terms', 'uses' => 'Frontend\InfoController@getTerms']);

    // requesting the contact page
    get('contact', ['as' => 'contact', 'uses' => 'Frontend\InfoController@getContact']);

    // this will handle the action of a user sending a message to us. since the form is already by default on the page, we don't need a GET request
    post('contact', ['as' => 'contact.post', 'uses' => 'Frontend\InfoController@postContactMessage']);
});

// authentication
Route::group(['prefix' => 'account', 'middleware' => ['https']], function () {

    // login
    Route::group(['prefix' => 'login'], function () {

        // requesting the login page
        get('/', ['as' => 'login', 'uses' => 'Shared\AuthController@getLogin']);

        // posting to the login page, for credentials validation
        post('/', ['as' => 'login.verify', 'uses' => 'Shared\AuthController@postLogin']);

        // API login
        get('/oauth2', ['as' => 'auth.loginUsingAPI', 'uses' => 'Shared\AuthController@apiLogin']);
    });

    // registration
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

    // password reset
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

// usr account
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

});

// ads
Route::group(['prefix' => 'advertisements'], function () {

    get('{advert}/', ['as' => 'ads.product', 'uses' => 'Frontend\AdvertisementsController@show']);
});

// categories
Route::group(['prefix' => 'categories', 'middleware' => ['http']], function () {
    // listing categories. sort of sitemaping, or whatever
    get('/', ['as' => 'allCategories', 'uses' => 'Frontend\CategoriesController@index']);

    // display all products in the category, regardless of sub-category
    get('/{category}', ['as' => 'categories.shop', 'uses' => 'Frontend\CategoriesController@show']);
});

// subcategories
Route::group(['prefix' => 'sub-categories', 'middleware' => ['http']], function () {

    get('/', ['as' => 'allSubCategories', 'uses' => 'Frontend\SubcategoriesController@index']);

    get('/{subcategory}', ['as' => 'subcategories.shop', 'uses' => 'Frontend\SubCategoriesController@show']);
});

// products
Route::group(['prefix' => 'products', 'middleware' => ['http']], function () {

    get('/', ['as' => 'allProducts', 'uses' => 'Frontend\ProductsController@index']);

    get('/{product}', ['as' => 'product.view', 'uses' => 'Frontend\ProductsController@show']);

    // email a product
    //post('/{id}/email', ['as' => 'products.email', 'uses' => 'Frontend\ProductsController@email']);
});

// brands
Route::group(['prefix' => 'brands', 'middleware' => ['http']], function () {

    get('/', ['as' => 'allBrands', 'uses' => 'Frontend\BrandsController@index']);

    get('/{brand}', ['as' => 'brands.shop', 'uses' => 'Frontend\BrandsController@show']);
});

// search
Route::group(['prefix' => 'search'], function () {
    // handles a search request from the client
    get('/', ['as' => 'client.search', 'uses' => 'Frontend\SearchController@show']);
});

/* ========================================
    SHOPPING CART
   ========================================
*/

Route::group(['prefix' => 'cart'], function () {
    get('/', ['as' => 'cart.index', 'uses' => 'Frontend\CartController@index']);
    // adding a product to the cart
    post('add/{id}', ['as' => 'cart.add', 'uses' => 'Frontend\CartController@store']);
    // listing all products in the cart
    get('/', ['as' => 'cart.view', 'uses' => 'Frontend\CartController@view']);
    // add a product to an existing cart
    patch('/update/{id}', ['as' => 'cart.update', 'uses' => 'Frontend\CartController@update']);

    delete('/update/{id}/remove', ['as' => 'cart.update.remove', 'uses' => 'Frontend\CartController@removeProduct']);

    // a users shopping cart
    Route::group(['prefix' => 'mine', 'middleware' => ['https', 'auth']], function(){

        get('/', ['as' => 'mycart', 'uses' => 'Frontend\CartController@mine']);
    });
});

/* ========================================
    REVIEWING A PRODUCT
   ========================================
*/
Route::group(['prefix' => 'reviews', 'middleware' => ['https', 'auth']], function () {

    post('/save/product/{productID}', ['as' => 'product.reviews.store', 'uses' => 'Frontend\ReviewsController@store', 'middleware' => 'reviews.check']);

    patch('/edit/{id}', ['as' => 'product.reviews.update', 'uses' => 'Frontend\ReviewsController@update']);
});

/* ========================================
    CHECKING OUT
   ========================================
*/
get('checkout/begin', ['as' => 'checkout.auth', 'uses' => 'Frontend\GuestCheckoutController@auth', 'middleware' => ['https', 'cart.check']]);

// checking out as a guest user
Route::group(['prefix' => 'checkout/g', 'middleware' => ['https', 'cart.check', 'checkout.guest']], function () {

    get('/', ['as' => 'checkout.step1', 'uses' => 'Frontend\GuestCheckoutController@guestInfo']);

    post('/aboutMe', ['as' => 'checkout.step1.store', 'uses' => 'Frontend\GuestCheckoutController@postGuestInfo']);

    patch('/aboutMe', ['as' => 'checkout.step1.edit', 'uses' => 'Frontend\GuestCheckoutController@editShippingAddress']);

    get('/shipping', ['as' => 'checkout.step2', 'uses' => 'Frontend\GuestCheckoutController@shipping']);

    patch('/shipping', ['as' => 'checkout.step2', 'uses' => 'Frontend\GuestCheckoutController@patchShipping']);

    get('/payment', ['as' => 'checkout.step3', 'uses' => 'Frontend\GuestCheckoutController@payment']);

    post('/payment', ['as' => 'checkout.step3.post', 'uses' => 'Frontend\GuestCheckoutController@storePayment']);

    get('/reviewOrder', ['as' => 'checkout.step4', 'uses' => 'Frontend\GuestCheckoutController@reviewOrder']);

    post('/placeOrder', ['as' => 'checkout.submitOrder', 'uses' => 'Frontend\OrdersController@store']);

    get('/viewInvoice', ['as' => 'checkout.viewInvoice', 'uses' => 'Frontend\OrdersController@displayInvoice']);

    post('/createAccount', ['as' => 'checkout.createAccount', 'uses' => 'Frontend\GuestCheckoutController@store']);

    get('/invoice/pdf', ['as' => 'checkout.viewInvoice.pdf', 'uses' => 'Frontend\OrdersController@printInvoice']);
});

// checking out as a normal authenticated user
Route::group(['prefix' => 'checkout', 'middleware' => ['https', 'checkout.user']], function () {

    get('/', ['as' => 'u.checkout.step2', 'uses' => 'Frontend\AuthUserCheckoutController@index']);

    patch('/shipping', ['as' => 'u.checkout.step2.patch', 'uses' => 'Frontend\AuthUserCheckoutController@shipping']);

    get('/payment', ['as' => 'u.checkout.step3', 'uses' => 'Frontend\AuthUserCheckoutController@payment']);

    post('/payment', ['as' => 'u.checkout.step3.post', 'uses' => 'Frontend\AuthUserCheckoutController@storePayment']);

    get('/reviewOrder', ['as' => 'u.checkout.step4', 'uses' => 'Frontend\AuthUserCheckoutController@reviewOrder']);

    get('/viewInvoice', ['as' => 'u.checkout.viewInvoice', 'uses' => 'Frontend\OrdersController@displayInvoice']);

    get('/invoice/pdf', ['as' => 'u.checkout.viewInvoice.pdf', 'uses' => 'Frontend\OrdersController@printInvoice']);

    post('/placeOrder', ['as' => 'u.checkout.submitOrder', 'uses' => 'Frontend\OrdersController@store']);

});

// users orders
Route::group(['prefix' => 'myorders', 'middleware' => ['https', 'auth', 'orders.verify']], function(){

    get('/', ['as' => 'myorders', 'uses' => 'Frontend\OrdersController@index']);

});
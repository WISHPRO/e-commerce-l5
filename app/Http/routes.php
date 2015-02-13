<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');
//
//Route::get('home', 'HomeController@index');
//
//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);


/*=========================================
    DEFAULT ROUTE,
    ie the root of our lovely site /
 ==========================================
*/


Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index', 'middleware' => ['no-ssl']]);
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index', 'middleware' => ['no-ssl']]);

/*=========================================
    USER HELP
 ==========================================
*/
Route::group(['prefix' => 'help', 'middleware' => ['no-ssl']], function () {

	/*
     * Account reset actions
     * */
	Route::group(['prefix' => 'account', 'middleware' => 'force-ssl'], function () {
		/* allows a non-logged in user to reset their password.
        This will allow them to enter their email
        and recieve a token which we shall then verify below
        */
		Route::post('reset', ['as' => 'account.reset', 'uses' => 'AuthController@resetPassword']);
		// process a reset password request, by verifying the token we sent earlier
		Route::post('reset/{token}', ['as' => 'account.reset', 'uses' => 'AuthController@verifyToken']);
		// now, we process the password the user wants
		Route::post('new_password', ['as' => 'account.reset', 'uses' => 'AuthController@resetPassword']);
	});

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
Route::group(['prefix' => 'info', 'middleware' => ['no-ssl']], function () {

	// requesting the about page
	Route::get('about', ['as' => 'about', 'uses' => 'InfoController@about']);
	// requesting the terms & conditions page
	Route::get('terms', ['as' => 'terms', 'uses' => 'InfoController@terms']);
	// requesting the contact page
	Route::get('contact', ['as' => 'contact', 'uses' => 'InfoController@contact']);
	// this will handle the action of a user sending a message to us. since the form is already by default on the page, we don't need a GET request
	Route::post('contact', ['as' => 'contact.post', 'uses' => 'InfoController@store']);
});

/*=========================================
    SIMPLE AUTHENTICATION
  =========================================
*/

Route::group(['prefix' => 'account', 'middleware' => ['force-ssl']], function () {
	// requesting the login page
	Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
	// posting to the login page, for credentials validation
	Route::post('login', ['as' => 'login.verify', 'uses' => 'AuthController@postLogin']);
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
	/*
     * User registration
     * */
	Route::get('register', ['as' => 'register', 'uses' => 'AuthController@getRegister']);
	Route::post('register', ['as' => 'registration.store', 'uses' => 'AuthController@postRegister']);

	// allowing a non-looged in user to reset their password. This will allow them to enter their email
	// and recieve a token which we shall then verify below
	Route::group(['prefix' => 'reset'], function(){

		Route::get('/', ['as' => 'password.reset', 'uses' => 'PasswordController@getEmail']);
		Route::post('/', ['as' => 'reset.postEmail', 'uses' => 'PasswordController@postEmail']);

		// http://localhost:8000/account/password/requestNewPassword?token=a54f44f334e503055dfe3a1b10ea6a705e05123a
		// process a reset password request
		Route::get('/requestNewPassword/{token}', ['as' => 'reset.start', 'uses' => 'PasswordController@getReset']);
		Route::post('/saveNewPassword', ['as' => 'reset.finish', 'uses' => 'PasswordController@postReset']);
	});

});

/*=========================================
    USER'S ACCOUNT
  =========================================
*/

Route::group(['prefix' => "myaccount", 'middleware' => ['auth', 'force-ssl']], function () {
	// requesting to logout


	// account customizations
	Route::get('/', ['as' => 'myaccount', 'uses' => 'UsersController@index']);
	Route::put('/edit', ['as' => 'myaccount.edit', 'uses' => 'UsersController@update']);
	Route::delete('/delete', ['as' => 'myaccount.delete', 'uses' => 'UsersController@destroy']);

	// a logged in user should be able to reset their password too. The url might change, but the reference controller doesn't
	Route::get('/reset_password', ['as' => 'my_account.password.reset', 'uses' => 'AuthController@resetPassword']);

	Route::get('/cart', ['as' => 'my_cart', 'uses' => 'CartController@history']);
	Route::get('/orders', ['as' => 'my_orders', 'uses' => 'OrdersController@orders']);
	Route::get('/order-history', ['as' => 'my_order_trail', 'uses' => 'OrdersController@history']);

});

/* ========================================
    PRODUCTS
   ========================================
*/

Route::group(['prefix' => 'products', 'middleware' => ['no-ssl']], function () {
	// this will handle user requests to view a specific product
	// such requests expecting an id & name should come from search, categories view page, etc
	Route::get('{id}/', ['as' => 'product.view', 'uses' => 'ProductsController@show']);
	// display all products, regardless of category, subcategory, etc. this shall be removed in future
	Route::get('/', ['as' => 'allproducts', 'uses' => 'ProductsController@index']);
});

/* ========================================
    CATEGORIES
   ========================================
*/

Route::group(['prefix' => 'categories', 'middleware' => ['no-ssl']], function () {
	// listing categories. sort of sitemaping, or whatever
	Route::get('/', ['as' => 'categories.display', 'uses' => 'CategoriesController@index']);

	// display all products in the category, regardless of sub-category
	Route::get('/{id}', ['as' => 'categories.view', 'uses' => 'CategoriesController@show']);
});

/* ========================================
    SUB-CATEGORIES
   ========================================
*/

Route::group(['prefix' => 'sub-categories', 'middleware' => ['no-ssl']], function () {
	// this will handle requests straight from the sidebar. Expects a subcategoryID
	Route::get('/{subCatID}', ['as' => 'subcategories.view', 'uses' => 'SubCategoriesController@show']);
});

/* ========================================
    SHOP BY BRANDS
   ========================================
*/

Route::group(['prefix' => 'brands', 'middleware' => ['no-ssl']], function () {

	Route::get('/{id}/{name}/shop', ['as' => 'brands.shop', 'uses' => 'BrandsController@show']);
});

/* ========================================
    SEARCHING, ON THE CLIENT SIDE
   ========================================
*/

Route::group(['prefix' => 'search', 'middleware' => ['no-ssl']], function () {
	// handles a search request from the client
	Route::get('/', ['as' => 'client.search', 'uses' => 'SearchController@show']);
});

/* ========================================
    WISH LISTS
   ========================================
*/
// the wishlist landing page
Route::get('/wishlist', ['as' => 'wishlist', 'uses' => 'WishlistsController@index', 'middleware' => ['no-ssl']]);

Route::group(['prefix' => 'wishlist', 'middleware' => ['auth', 'force-ssl']], function () {
	// creating a new wishlist
	Route::get('/create', ['as' => 'mywishlist.create', 'uses' => 'WishlistsController@create']);
	// adding a product to the wishlist
	Route::post('add_product/{id}', ['as' => 'mywishlist.add', 'uses' => 'WishlistsController@add']);
	//listing all the authenticated user's wishlists
	Route::get('/view', ['as' => 'mywishlist', 'uses' => 'WishlistsController@view']);
	// viewing a particular wishlist
	Route::get('/{id}/show', ['as' => 'mywishlist.view', 'uses' => 'WishlistsController@show']);
	// removing a product from the wishlist
	Route::delete('remove_product/{id}', ['as' => 'mywishlist.update', 'uses' => 'WishlistsController@edit']);
});

/* ========================================
    SHOPPING CART
   ========================================
*/

Route::group(['prefix' => 'cart'], function () {
	// adding a product to the cart
	Route::post('add_product/{id}', ['as' => 'cart.add', 'uses' => 'CartController@store']);
	// listing all products in the cart
	Route::get('/view_products', ['as' => 'cart.view', 'uses' => 'CartController@view']);
	// add a product to an existing cart
	Route::put('/update/add_product/{id}', ['as' => 'cart.update.add', 'uses' => 'CartController@update']);
	// removing a product from an existing cart
	Route::delete('/update/remove_product/{id}', ['as' => 'cart.update.remove', 'uses' => 'CartController@removeProduct']);
});

/* ========================================
    CHECKING OUT
   ========================================
*/

Route::group(['prefix' => 'checkout', 'middleware' => ['auth', 'force-ssl']], function () {
	// initial checkout page, which displays the checkout form
	Route::get('/begin_checkout', ['as' => 'checkout.start', 'uses' => 'CheckoutController@process']);
	// checkout steps
	Route::post('/checkout_steps/{id}', ['as' => 'checkout.steps', 'uses' => 'CheckoutController@processSteps']);
});

// product reviews test
Route::group(['prefix' => 'reviews', 'middleware' => ['auth', 'force-ssl']], function () {

	Route::get('product/{id}/save', ['as' => 'reviews.post', 'uses' => 'ReviewsController@index']);
});
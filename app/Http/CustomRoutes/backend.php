<?php
/* ========================================
    ADMINISTRATIVE ROUTES SECTION
   ========================================
*/

// authentication
Route::group(['prefix' => 'backend', 'middleware' => ['https', 'backend-access']], function () {

    get('login', ['as' => 'backend.login', 'uses' => 'Shared\AuthController@getLogin']);
    post('login', ['as' => 'backend.login.post', 'uses' => 'Shared\AuthController@postLogin']);
    get('logout', ['as' => 'backend.logout', 'uses' => 'Shared\AuthController@getLogout']);
});

/*
 * Backend routes. all restful
 *
 * The following middleware filters are used, for the backend
 * ============================================
 * https, authentication, access, authorization
 * ============================================
 * https: enforces backend access via https
 * access: controls access to the backend via IP checking
 * authentication: enforces backend login
 * authorization: checks the roles of the authenticating user, for a match
 *
 * */
Route::group(['prefix' => 'backend', 'middleware' => ['https', 'backend-access', 'auth.backend', 'backend-authorization']], function () {

    // backend home page
    get('/', ['as' => 'backend', 'uses' => 'Backend\HomeController@index']);

    // roles and permissions
    Route::group(['prefix' => 'security'], function () {

        // roles
        resource('roles', 'Backend\RolesController');

        // permissions
        resource('permissions', 'Backend\PermissionsController');

        // access control. defining permissions used by roles, and users assigned this roles
        Route::group(['prefix' => 'access-control'], function () {
            resource('roles', 'Backend\UserRolesController');
        });

    });

    // ads
    resource('ads', 'Backend\AdvertisementsController');

    // counties
    resource('counties', 'Backend\CountiesController');

    // products
    resource('products', 'Backend\ProductsController');

    // brands
    resource('brands', 'Backend\BrandsController');

    // categories
    resource('categories', 'Backend\CategoriesController');

    // subcategories
    resource('subcategories', 'Backend\SubCategoriesController');

    // users
    resource('users', 'Backend\UsersController');

    // accounts
    Route::group(['prefix' => "myaccount"], function () {

        // account customizations
        get('/', ['as' => 'backend.myaccount', 'uses' => 'Shared\AccountController@index']);

        patch('/Info/contact', ['as' => 'backend.account.info.contact.edit', 'uses' => 'Shared\AccountController@patchContacts']);

        patch('/Info/personal', ['as' => 'backend.account.info.personal.edit', 'uses' => 'Shared\AccountController@patchAccount']);

        patch('/Info/shipping', ['as' => 'backend.account.info.shipping.edit', 'uses' => 'Shared\AccountController@patchShipping']);

        patch('/password/new', ['as' => 'backend.account.password.edit', 'uses' => 'Shared\AccountController@patchPassword']);

        get('/delete', ['as' => 'backend.account.delete', 'uses' => 'Shared\AccountController@getDelete']);

        delete('/delete', ['as' => 'backend.account.delete', 'uses' => 'Shared\AccountController@deleteAccount']);

        delete('/destroy', ['as' => 'backend.account.delete.permanent', 'uses' => 'Shared\AccountController@destroy']);

        get('/cart', ['as' => 'backend.mycart', 'uses' => 'Frontend\CartController@history']);

        get('/orders', ['as' => 'backend.myorders', 'uses' => 'Frontend\OrdersController@orders']);

        get('/orders/history', ['as' => 'backend.myorder-history', 'uses' => 'Frontend\OrdersController@history']);

    });
});
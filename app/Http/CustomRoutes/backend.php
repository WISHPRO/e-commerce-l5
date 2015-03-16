<?php
/* ========================================
    ADMINISTRATIVE ROUTES SECTION
   ========================================
*/

// authentication
Route::group(['prefix' => 'backend'], function () {

    get('login', ['as' => 'backend.login', 'uses' => 'Auth\Backend\AuthController@getLogin']);
    post('login', ['as' => 'backend.login.post', 'uses' => 'Auth\Backend\AuthController@postLogin']);
    get('logout', ['as' => 'backend.logout', 'uses' => 'Auth\Backend\AuthController@getLogout']);
});

/*
 * Backend routes. all restful
 *
 * Filters: https, authentication, access, authorization
 * https: enforces backend access via https
 * authentication: enforces backend login
 * access: controls access to the backend via IP checking
 * authorization: checks the roles of the authenticating user, for a match
 *
 * */
Route::group(['prefix' => 'backend', 'middleware' => ['https', 'auth.backend', 'backend-access', 'backend-authorization']], function () {

    // backend home page
    get('/', ['as' => 'backend', 'uses' => 'Backend\HomeController@index']);

    // current user's account
    resource('myaccount', 'Backend\AccountController');

    // roles and permissions
    Route::group(['prefix' => 'security'], function () {

        resource('roles', 'Backend\RolesController');

        resource('permissions', 'Backend\PermissionsController');

        Route::group(['prefix' => 'acls'], function () {
            resource('roles', 'Backend\UserRolesController');
        });

    });

    // system statistics
    Route::group(['prefix' => 'statistics'], function () {

        get('/', ['as' => 'backend.statistics', 'uses' => 'Backend\StatisticsController@index']);
        get('/users', ['as' => 'backend.statistics.users', 'uses' => 'Backend\StatisticsController@getUserStatistics']);
        get('/security', ['as' => 'backend.statistics.security', 'uses' => 'Backend\StatisticsController@getSecurityStatistics']);
        get('/sales', ['as' => 'backend.statistics.sales', 'uses' => 'Backend\StatisticsController@getSalesStatistics']);
        get('/inventory', ['as' => 'backend.statistics.inventory', 'uses' => 'Backend\StatisticsController@getInventoryStatistics']);
        get('/shipping', ['as' => 'backend.statistics.county', 'uses' => 'Backend\StatisticsController@getCountyStatistics']);
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

});
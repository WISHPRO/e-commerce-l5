<?php
/* ========================================
    ADMINISTRATIVE ROUTES SECTION
   ========================================
*/

// authentication
Route::group(
    [ 'prefix' => 'backend' ],
    function () {
        // displaying the login page
        Route::get( 'login', [ 'as' => 'backend.login', 'uses' => 'Auth\Backend\AuthController@getLogin' ] );
        // a post request for verifying login credentials
        Route::post( 'login', [ 'as' => 'backend.login.post', 'uses' => 'Auth\Backend\AuthController@postLogin' ] );
        // loging out the user
        Route::get( 'logout', [ 'as' => 'backend.logout', 'uses' => 'Auth\Backend\AuthController@getLogout' ] );
    }
);

// main backend routes. all restful
Route::group(
    [ 'prefix' => 'backend', 'middleware' => [ 'auth.backend', 'backend-access' ] ],
    function () {

        // backend home page
        Route::get( '/', [ 'as' => 'backend', 'uses' => 'Backend\HomeController@index' ] );

        // roles and permissions
        Route::group([ 'prefix' => 'security' ], function () {

            Route::resource('roles', 'Backend\RolesController');

            Route::resource('permissions', 'Backend\PermissionsController');

            Route::group(['prefix' => 'acls'], function(){

                Route::resource('roles', 'Backend\UserRolesController');

            });

        });

        // counties
        Route::resource('counties', 'Backend\CountiesController');

        // products
        Route::resource('products', 'Backend\ProductsController');

        // brands
        Route::resource('brands', 'Backend\BrandsController');

        // categories
        Route::resource('categories', 'Backend\CategoriesController');

        // subcategories
        Route::resource('subcategories', 'Backend\SubCategoriesController');

        // users
        Route::resource('users', 'Backend\UsersController');

    }
);//
<?php
/* ========================================
    ADMINISTRATIVE ROUTES SECTION
   ========================================
*/

// authentication
Route::group(
    ['prefix' => 'backend'],
    function () {
        // displaying the login page
        get(
            'login',
            [
                'as'   => 'backend.login',
                'uses' => 'Auth\Backend\AuthController@getLogin'
            ]
        );
        // a post request for verifying login credentials
        post(
            'login',
            [
                'as'   => 'backend.login.post',
                'uses' => 'Auth\Backend\AuthController@postLogin'
            ]
        );
        // loging out the user
        get(
            'logout',
            [
                'as'   => 'backend.logout',
                'uses' => 'Auth\Backend\AuthController@getLogout'
            ]
        );
    }
);

// main backend routes. all restful
Route::group(
    ['prefix' => 'backend', 'middleware' => ['auth.backend', 'backend-access']],
    function () {

        // backend home page
        get(
            '/',
            ['as' => 'backend', 'uses' => 'Backend\HomeController@index']
        );

        // roles and permissions
        Route::group(
            ['prefix' => 'security'],
            function () {

                resource('roles', 'Backend\RolesController');

                //resource('permissions', 'Backend\PermissionsController');

                Route::group(
                    ['prefix' => 'acls'],
                    function () {

                        resource('roles', 'Backend\UserRolesController');

                    }
                );

            }
        );

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

    }
);//
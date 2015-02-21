<?php
/* ========================================
    ADMINISTRATIVE ROUTES SECTION
   ========================================
*/

/* For backend authentication. Only the ssl filter required, for now
*/
Route::group(
    [ 'prefix' => 'backend', 'middleware' => [ 'force-ssl' ] ],
    function () {
        // displaying the admin login page
        Route::get( 'login', [ 'as' => 'backend.login', 'uses' => 'Auth\BackendAuthController@getLogin' ] );
        // a post request for verifying login credentials
        Route::post( 'login', [ 'as' => 'backend.login.post', 'uses' => 'Auth\BackendAuthController@postLogin' ] );
        // loging out the admin
        Route::get( 'logout', [ 'as' => 'backend.logout', 'uses' => 'Auth\BackendAuthController@getLogout' ] );
    }
);

/* now, here comes the collection of all administrative routes.
 * A user is required to be on the local machine, have the admin role,
 * and have the full-system-access permission,
 * so as to use this routes. otherwise, an error page is shows
*/
Route::group(
    [ 'prefix' => 'backend/admin', 'middleware' => [ 'force-ssl', 'auth.backend', 'backend-access' ] ],
    function () {

        // a default fallback whenever a backend user is authenticated and we need to redirect here, like if an error occurs
        Route::get( '/', [ 'as' => 'backend', 'uses' => 'Backend\BackendController@index' ] );

        /*
         * For system roles and permissions
         * */
        Route::group(
            [ 'prefix' => 'system/roles' ],
            function () {
                // view the roles
                Route::get( '/', [ 'as' => 'roles.view', 'uses' => 'Backend\RolesController@index' ] );
                Route::get( '/add', [ 'as' => 'roles.create', 'uses' => 'Backend\RolesController@create' ] );
                Route::post( '/add', [ 'as' => 'roles.store', 'uses' => 'Backend\RolesController@store' ] );
                // assign roles
                Route::get(
                    '/users/assign',
                    [ 'as' => 'roles.assign', 'uses' => 'Backend\RolesController@getAssignRolesToUsers' ]
                );
                Route::post(
                    '/users/assign',
                    [ 'as' => 'roles.assign.add', 'uses' => 'Backend\RolesController@AssignRolesToUsers' ]
                );//for now;
                Route::get(
                    '/permissions/assign',
                    [ 'as' => 'roles.permissions.get', 'uses' => 'Backend\RolesController@getAssignPermissions' ]
                );
                Route::post(
                    '/permissions/assign',
                    [ 'as' => 'roles.permissions.add', 'uses' => 'Backend\RolesController@AssignPermissions' ]
                );

                // updating roles
                Route::get(
                    'roles/update/{id}',
                    [ 'as' => 'roles.edit', 'uses' => 'Backend\RolesController@edit' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::put(
                    'roles/update/{id}',
                    [ 'as' => 'roles.update', 'uses' => 'Backend\RolesController@update' ]
                )->where( 'id', '[1-9][0-9]*' );

                // revoking user roles
                Route::get(
                    'roles/user/revoke',
                    [ 'as' => 'roles.revoke', 'uses' => 'Backend\RolesController@getRevoke' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::delete(
                    'roles/{id}/user/{user_id}/revoke',
                    [ 'as' => 'roles.revoke.remove', 'uses' => 'Backend\RolesController@Revoke' ]
                )->where( 'id', '[1-9][0-9]*' );

                // deleting a role
                Route::delete(
                    'roles/delete/{id}',
                    [ 'as' => 'roles.delete', 'uses' => 'Backend\RolesController@destroy' ]
                )->where( 'id', '[1-9][0-9]*' );

                // permissions
                Route::get(
                    'permissions',
                    [ 'as' => 'permissions.view', 'uses' => 'Backend\PermissionsController@index' ]
                );
                Route::get(
                    'permissions/add',
                    [ 'as' => 'permissions.create', 'uses' => 'Backend\PermissionsController@create' ]
                );
                Route::post(
                    'permissions/add',
                    [ 'as' => 'permissions.store', 'uses' => 'Backend\PermissionsController@store' ]
                );
                Route::get(
                    'permissions/update/{id}',
                    [ 'as' => 'permissions.edit', 'uses' => 'Backend\PermissionsController@edit' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::put(
                    'permissions/update/{id}',
                    [ 'as' => 'permissions.update', 'uses' => 'Backend\PermissionsController@update' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::delete(
                    'permissions/delete/{id}',
                    [ 'as' => 'permissions.delete', 'uses' => 'Backend\PermissionsController@destroy' ]
                )->where( 'id', '[1-9][0-9]*' );
            }
        );

        /*
        * For system issues..eg logs
        * */
        Route::group(
            [ 'prefix' => 'system' ],
            function () {
                Route::get( '/', [ 'as' => 'system.logs', 'uses' => 'LogsController@index' ] );
            }
        );

        /*
        * For the counties. Really wasn't required, but still forced it in
        * */

        Route::group(
            [ 'prefix' => 'counties' ],
            function () {
                // list all counties
                Route::get( '/', [ 'as' => 'counties.view', 'uses' => 'Backend\BackendCountiesController@index' ] );
                // request to create a county
                Route::get(
                    '/add',
                    [ 'as' => 'counties.create', 'uses' => 'Backend\BackendCountiesController@create' ]
                );
                // the actual post & validation of input before saving a new county
                Route::post(
                    '/add',
                    [ 'as' => 'counties.store', 'uses' => 'Backend\BackendCountiesController@store' ]
                );
                // editing a category
                Route::get(
                    '/update/{id}',
                    [ 'as' => 'counties.show', 'uses' => 'Backend\BackendCountiesController@show' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::put(
                    '/update/{id}',
                    [ 'as' => 'counties.update', 'uses' => 'Backend\BackendCountiesController@update' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::delete(
                    '/delete/{id}',
                    [ 'as' => 'counties.delete', 'uses' => 'Backend\BackendCountiesController@destroy' ]
                )->where( 'id', '[1-9][0-9]*' );

            }
        );

        /*
         * For products
        */

        // display all products
        Route::group(
            [ 'prefix' => 'products' ],
            function () {
                Route::get( '/', [ 'as' => 'products.view', 'uses' => 'Backend\BackendProductsController@index' ] );
                // request to add/create a product
                Route::get(
                    '/add',
                    [ 'as' => 'products.create', 'uses' => 'Backend\BackendProductsController@create' ]
                );
                // validation and adding of the product occurs using this route
                Route::post(
                    '/add',
                    [ 'as' => 'products.store', 'uses' => 'Backend\BackendProductsController@store' ]
                );
                // returns a form that allows an admin to update a product
                Route::get(
                    '/update/{id}',
                    [ 'as' => 'products.show', 'uses' => 'Backend\BackendProductsController@edit' ]
                )->where( 'id', '[1-9][0-9]*' );
                // handles validation and actual updating of the product
                Route::put(
                    '/update/{id}',
                    [ 'as' => 'products.update', 'uses' => 'Backend\BackendProductsController@update' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::delete(
                    '/delete/{id}',
                    [ 'as' => 'products.delete', 'uses' => 'Backend\BackendProductsController@destroy' ]
                )->where( 'id', '[1-9][0-9]*' );

            }
        );

        /*
        * For product brands
        * */
        Route::group(
            [ 'prefix' => 'brands' ],
            function () {

                Route::get( '/', [ 'as' => 'brands.view', 'uses' => 'Backend\BackendProductBrandsController@index' ] );
                // request to add/create a product
                Route::get(
                    '/add',
                    [ 'as' => 'brands.create', 'uses' => 'Backend\BackendProductBrandsController@create' ]
                );
                // validation and adding of the product occurs using this route
                Route::post(
                    '/add',
                    [ 'as' => 'brands.store', 'uses' => 'Backend\BackendProductBrandsController@store' ]
                );
                // returns a form that allows an admin to update a product
                Route::get(
                    '/update/{id}',
                    [ 'as' => 'brands.show', 'uses' => 'Backend\BackendProductBrandsController@edit' ]
                )->where( 'id', '[1-9][0-9]*' );
                // handles validation and actual updating of the product
                Route::put(
                    '/update/{id}',
                    [ 'as' => 'brands.update', 'uses' => 'Backend\BackendProductBrandsController@update' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::delete(
                    '/delete/{id}',
                    [ 'as' => 'brands.delete', 'uses' => 'Backend\BackendProductBrandsController@destroy' ]
                )->where( 'id', '[1-9][0-9]*' );
            }
        );

        /*
        * Product categories
        * */

        Route::group(
            [ 'prefix' => 'categories' ],
            function () {
                // list all categories
                Route::get( '/', [ 'as' => 'categories.view', 'uses' => 'Backend\BackendCategoriesController@index' ] );
                // request to create a category
                Route::get(
                    '/add',
                    [ 'as' => 'categories.create', 'uses' => 'Backend\BackendCategoriesController@create' ]
                );
                // the actual post & validation of input before saving a new category
                Route::post(
                    '/add',
                    [ 'as' => 'categories.store', 'uses' => 'Backend\BackendCategoriesController@store' ]
                );
                // editing a category
                Route::get(
                    '/update/{id}',
                    [ 'as' => 'categories.show', 'uses' => 'Backend\BackendCategoriesController@show' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::put(
                    '/update/{id}',
                    [ 'as' => 'categories.update', 'uses' => 'Backend\BackendCategoriesController@update' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::delete(
                    '/delete/{id}',
                    [ 'as' => 'categories.delete', 'uses' => 'Backend\BackendCategoriesController@destroy' ]
                )->where( 'id', '[1-9][0-9]*' );

            }
        );

        /* Product sub categories
            */
        Route::group(
            [ 'prefix' => 'subcategories' ],
            function () {
                // list all sub-categories
                Route::get(
                    '/',
                    [ 'as' => 'subcategories.view', 'uses' => 'Backend\BackendSubCategoriesController@index' ]
                );
                // request to create a sub-category
                Route::get(
                    '/add',
                    [ 'as' => 'subcategories.create', 'uses' => 'Backend\BackendSubCategoriesController@create' ]
                );
                // the actual post & validation of input before saving a new sub-category
                Route::post(
                    '/add',
                    [ 'as' => 'subcategories.store', 'uses' => 'Backend\BackendSubCategoriesController@store' ]
                );
                // editing a sub-category
                Route::get(
                    '/update/{id}',
                    [ 'as' => 'subcategories.show', 'uses' => 'Backend\BackendSubCategoriesController@show' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::put(
                    '/update/{id}',
                    [ 'as' => 'subcategories.update', 'uses' => 'Backend\BackendSubCategoriesController@update' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::delete(
                    '/delete/{id}',
                    [ 'as' => 'subcategories.delete', 'uses' => 'Backend\BackendSubCategoriesController@destroy' ]
                )->where( 'id', '[1-9][0-9]*' );
            }
        );

        /*
           * For users
          */
        Route::group(
            [ 'prefix' => 'users' ],
            function () {
                // listing all users
                Route::get( '/', [ 'as' => 'users.view', 'uses' => 'Backend\BackendUsersController@index' ] );
                // requesting to create a user, and actually creating one
                Route::get( '/add', [ 'as' => 'users.create', 'uses' => 'Backend\BackendUsersController@create' ] );
                Route::post( '/add', [ 'as' => 'users.store', 'uses' => 'Backend\BackendUsersController@store' ] );
                // updating a user
                Route::put(
                    '/{id}/update/',
                    [ 'as' => 'users.update', 'uses' => 'Backend\BackendUsersController@update' ]
                )->where( 'id', '[1-9][0-9]*' );
                Route::get(
                    '/{id}/update',
                    [ 'as' => 'users.show', 'uses' => 'Backend\BackendUsersController@edit' ]
                )->where( 'id', '[1-9][0-9]*' );
//        Route::get('/{id}/update_password', ['as' => 'users.password.update', 'uses' => 'Backend\BackendUsersController@editPassword'])->where('id', '[1-9][0-9]*');
//        Route::put('/{id}/update_password', ['as' => 'users.password.save', 'uses' => 'Backend\BackendUsersController@storeNewPassword'])->where('id', '[1-9][0-9]*');
                // deleting a user account
                Route::delete(
                    '/{id}/delete',
                    [ 'as' => 'users.delete', 'uses' => 'Backend\BackendUsersController@destroy' ]
                )->where( 'id', '[1-9][0-9]*' );
            }
        );

    }
);//
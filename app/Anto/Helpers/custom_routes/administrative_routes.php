<?php
/* ========================================
    ADMINISTRATIVE ROUTES SECTION
   ========================================
*/

/* For backend authentication. Only the ssl filter required, for now
*/
Route::group(['prefix' => 'backend', 'middleware' => ['force-ssl']], function () {
    // displaying the admin login page
    Route::get('login', ['as' => 'backend.login', 'uses' => 'AuthController@getLogin']);
    // a post request for verifying login credentials
    Route::post('login', ['as' => 'backend.login.post', 'uses' => 'AuthController@postLogin']);
    // loging out the admin
    Route::get('logout', ['as' => 'backend.logout', 'uses' => 'AuthController@getLogout']);
});

/* now, here comes the collection of all administrative routes.
 * A user is required to be on the local machine, have the admin role,
 * and have the full-system-access permission,
 * so as to use this routes. otherwise, an error page is shows
*/
Route::group(['prefix' => 'backend/admin', 'middleware' => ['force-ssl', 'backend-access']], function () {

    // a default fallback whenever a backend user is authenticated and we need to redirect here, like if an error occurs
    Route::get('/', ['as' => 'backend', 'uses' => 'BackendController@index']);

    /*
     * For system roles and permissions
     * */
    Route::group(['prefix' => 'system/roles'], function () {
        // view the roles
        Route::get('/', ['as' => 'roles.view', 'uses' => 'RolesController@index']);
        Route::get('/add', ['as' => 'roles.create', 'uses' => 'RolesController@create']);
        Route::post('/add', ['as' => 'roles.store', 'uses' => 'RolesController@store']);
        // assign roles
        Route::get('/users/assign', ['as' => 'roles.assign', 'uses' => 'RolesController@getAssignRolesToUsers']);
        Route::post('/users/assign', ['as' => 'roles.assign.add', 'uses' => 'RolesController@AssignRolesToUsers']);//for now;
        Route::get('/permissions/assign', ['as' => 'roles.permissions.get', 'uses' => 'RolesController@getAssignPermissions']);
        Route::post('/permissions/assign', ['as' => 'roles.permissions.add', 'uses' => 'RolesController@AssignPermissions']);

        // updating roles
        Route::get('roles/update/{id}', ['as' => 'roles.edit', 'uses' => 'RolesController@edit'])->where('id', '[1-9][0-9]*');
        Route::put('roles/update/{id}', ['as' => 'roles.update', 'uses' => 'RolesController@update'])->where('id', '[1-9][0-9]*');

        // revoking user roles
        Route::get('roles/user/revoke', ['as' => 'roles.revoke', 'uses' => 'RolesController@getRevoke'])->where('id', '[1-9][0-9]*');
        Route::delete('roles/{id}/user/{user_id}/revoke', ['as' => 'roles.revoke.remove', 'uses' => 'RolesController@Revoke'])->where('id', '[1-9][0-9]*');

        // deleting a role
        Route::delete('roles/delete/{id}', ['as' => 'roles.delete', 'uses' => 'RolesController@destroy'])->where('id', '[1-9][0-9]*');

        // permissions
        Route::get('permissions', ['as' => 'permissions.view', 'uses' => 'PermissionsController@index']);
        Route::get('permissions/add', ['as' => 'permissions.create', 'uses' => 'PermissionsController@create']);
        Route::post('permissions/add', ['as' => 'permissions.store', 'uses' => 'PermissionsController@store']);
        Route::get('permissions/update/{id}', ['as' => 'permissions.edit', 'uses' => 'PermissionsController@edit'])->where('id', '[1-9][0-9]*');
        Route::put('permissions/update/{id}', ['as' => 'permissions.update', 'uses' => 'PermissionsController@update'])->where('id', '[1-9][0-9]*');
        Route::delete('permissions/delete/{id}', ['as' => 'permissions.delete', 'uses' => 'PermissionsController@destroy'])->where('id', '[1-9][0-9]*');
    });

    /*
    * For system issues..eg logs
    * */
    Route::group(['prefix' => 'system'], function () {
        Route::get('/', ['as' => 'system.logs', 'uses' => 'LogsController@index']);
    });

    /*
    * For the counties. Really wasn't required, but still forced it in
    * */

    Route::group(['prefix' => 'counties'], function () {
        // list all counties
        Route::get('/', ['as' => 'counties.view', 'uses' => 'BackendCountiesController@index']);
        // request to create a county
        Route::get('/add', ['as' => 'counties.create', 'uses' => 'BackendCountiesController@create']);
        // the actual post & validation of input before saving a new county
        Route::post('/add', ['as' => 'counties.store', 'uses' => 'BackendCountiesController@store']);
        // editing a category
        Route::get('/update/{id}', ['as' => 'counties.show', 'uses' => 'BackendCountiesController@show'])->where('id', '[1-9][0-9]*');
        Route::put('/update/{id}', ['as' => 'counties.update', 'uses' => 'BackendCountiesController@update'])->where('id', '[1-9][0-9]*');
        Route::delete('/delete/{id}', ['as' => 'counties.delete', 'uses' => 'BackendCountiesController@destroy'])->where('id', '[1-9][0-9]*');

    });

    /*
     * For products
    */

    // display all products
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', ['as' => 'products.view', 'uses' => 'BackendProductsController@index']);
        // request to add/create a product
        Route::get('/add', ['as' => 'products.create', 'uses' => 'BackendProductsController@create']);
        // validation and adding of the product occurs using this route
        Route::post('/add', ['as' => 'products.store', 'uses' => 'BackendProductsController@store']);
        // returns a form that allows an admin to update a product
        Route::get('/update/{id}', ['as' => 'products.show', 'uses' => 'BackendProductsController@edit'])->where('id', '[1-9][0-9]*');
        // handles validation and actual updating of the product
        Route::put('/update/{id}', ['as' => 'products.update', 'uses' => 'BackendProductsController@update'])->where('id', '[1-9][0-9]*');
        Route::delete('/delete/{id}', ['as' => 'products.delete', 'uses' => 'BackendProductsController@destroy'])->where('id', '[1-9][0-9]*');

    });

    /*
    * For product brands
    * */
    Route::group(['prefix' => 'brands'], function () {

        Route::get('/', ['as' => 'brands.view', 'uses' => 'BackendProductBrandsController@index']);
        // request to add/create a product
        Route::get('/add', ['as' => 'brands.create', 'uses' => 'BackendProductBrandsController@create']);
        // validation and adding of the product occurs using this route
        Route::post('/add', ['as' => 'brands.store', 'uses' => 'BackendProductBrandsController@store']);
        // returns a form that allows an admin to update a product
        Route::get('/update/{id}', ['as' => 'brands.show', 'uses' => 'BackendProductBrandsController@edit'])->where('id', '[1-9][0-9]*');
        // handles validation and actual updating of the product
        Route::put('/update/{id}', ['as' => 'brands.update', 'uses' => 'BackendProductBrandsController@update'])->where('id', '[1-9][0-9]*');
        Route::delete('/delete/{id}', ['as' => 'brands.delete', 'uses' => 'BackendProductBrandsController@destroy'])->where('id', '[1-9][0-9]*');
    });

    /*
    * Product categories
    * */

    Route::group(['prefix' => 'categories'], function () {
        // list all categories
        Route::get('/', ['as' => 'categories.view', 'uses' => 'BackendCategoriesController@index']);
        // request to create a category
        Route::get('/add', ['as' => 'categories.create', 'uses' => 'BackendCategoriesController@create']);
        // the actual post & validation of input before saving a new category
        Route::post('/add', ['as' => 'categories.store', 'uses' => 'BackendCategoriesController@store']);
        // editing a category
        Route::get('/update/{id}', ['as' => 'categories.show', 'uses' => 'BackendCategoriesController@show'])->where('id', '[1-9][0-9]*');
        Route::put('/update/{id}', ['as' => 'categories.update', 'uses' => 'BackendCategoriesController@update'])->where('id', '[1-9][0-9]*');
        Route::delete('/delete/{id}', ['as' => 'categories.delete', 'uses' => 'BackendCategoriesController@destroy'])->where('id', '[1-9][0-9]*');

    });

    /* Product sub categories
        */
    Route::group(['prefix' => 'subcategories'], function () {
        // list all sub-categories
        Route::get('/', ['as' => 'subcategories.view', 'uses' => 'BackendSubCategoriesController@index']);
        // request to create a sub-category
        Route::get('/add', ['as' => 'subcategories.create', 'uses' => 'BackendSubCategoriesController@create']);
        // the actual post & validation of input before saving a new sub-category
        Route::post('/add', ['as' => 'subcategories.store', 'uses' => 'BackendSubCategoriesController@store']);
        // editing a sub-category
        Route::get('/update/{id}', ['as' => 'subcategories.show', 'uses' => 'BackendSubCategoriesController@show'])->where('id', '[1-9][0-9]*');
        Route::put('/update/{id}', ['as' => 'subcategories.update', 'uses' => 'BackendSubCategoriesController@update'])->where('id', '[1-9][0-9]*');
        Route::delete('/delete/{id}', ['as' => 'subcategories.delete', 'uses' => 'BackendSubCategoriesController@destroy'])->where('id', '[1-9][0-9]*');
    });

    /*
       * For users
      */
    Route::group(['prefix' => 'users'], function () {
        // listing all users
        Route::get('/', ['as' => 'users.view', 'uses' => 'BackendUsersController@index']);
        // requesting to create a user, and actually creating one
        Route::get('/add', ['as' => 'users.create', 'uses' => 'BackendUsersController@create']);
        Route::post('/add', ['as' => 'users.store', 'uses' => 'BackendUsersController@store']);
        // updating a user
        Route::put('/{id}/update/', ['as' => 'users.update', 'uses' => 'BackendUsersController@update'])->where('id', '[1-9][0-9]*');
        Route::get('/{id}/update', ['as' => 'users.show', 'uses' => 'BackendUsersController@edit'])->where('id', '[1-9][0-9]*');
//        Route::get('/{id}/update_password', ['as' => 'users.password.update', 'uses' => 'BackendUsersController@editPassword'])->where('id', '[1-9][0-9]*');
//        Route::put('/{id}/update_password', ['as' => 'users.password.save', 'uses' => 'BackendUsersController@storeNewPassword'])->where('id', '[1-9][0-9]*');
        // deleting a user account
        Route::delete('/{id}/delete', ['as' => 'users.delete', 'uses' => 'BackendUsersController@destroy'])->where('id', '[1-9][0-9]*');
    });

});//
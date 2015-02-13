<?php

use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /permissions
     *
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::paginate(10);

        return View::make('backend.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /permissions/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /permissions
     *
     * @return Response
     */
    public function store()
    {
        $permission = new Permission();
        $permission->name = Input::get('name');
        $permission->display_name = Input::get('display_name');

        if ($permission->save()) {
            return Redirect::route('permissions.view')->with('message', 'permission was successfully created. Now give users this permissions, by clicking '/*.link_to_route('permission.create', 'here')*/)->with('alertclass', 'alert-success');
        }
        return Redirect::back()->withErrors($permission->errors())->withInput()->with('message', 'Creating the permissions failed because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
    }

    /**
     * Display the specified resource.
     * GET /permissions/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return View::make('backend.permissions.edit', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /permissions/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return View::make('backend.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /permissions/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $permission = Permission::findOrFail($id);
        $data = Input::all();
        $permission->name = Input::get('name');
        $permission->display_name = Input::get('display_name');

        if ($permission->validate()) {
            return Redirect::back()->withErrors($permission->errors())->withInput()->with('message', 'update failed because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
        }

        $permission->update($data);

        return Redirect::route('permissions.view')->with('message', 'successfully updated permission with id ' . $id)->with('alertclass', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /permissions/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);

        return Redirect::route('permissions.view')->with('message', 'successfully deleted permission with id ' . $id)->with('alertclass', 'alert-success');
    }

}
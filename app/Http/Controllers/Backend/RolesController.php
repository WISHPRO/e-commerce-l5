<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use app\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Response;


class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /roles
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::paginate( 10 );

        return view( 'backend.Roles.index', compact( 'roles' ) );
    }

    /**
     * Show the form for creating a new resource.
     * GET /roles/create
     *
     * @return Response
     */
    public function create()
    {
        return view( 'backend.roles.create' );
    }

    /**
     * Store a newly created resource in storage.
     * POST /roles
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|alpha_dash|between:2,30|unique:roles',
            ]
        );

        $id = Role::create($request->all())->id;

        flash('Role was created successfully');

        redirect(action('Backend\RolesController@index'));
    }

    /**
     * Display the specified resource.
     * GET /roles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        $role = Role::findOrFail( $id );

        return view( 'backend.Roles.edit', compact( 'role' ) );
    }

    /**
     * Show the form for editing the specified resource.
     * GET /roles/{id}/edit
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        $role = Role::findOrFail( $id );

        return view( 'backend.Roles.edit', compact( 'role' ) );
    }

    /**
     * Update the specified resource in storage.
     * PUT /roles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( Request $request,  $id )
    {
        $this->validate(
            $request,
            [
                'name' => 'required|alpha_dash|between:2,30|unique:roles',
            ]
        );

        $role = Role::findOrFail( $id );

        $role->update( $request->all());

        flash()->success('The role was successfully updated');

        return redirect(action('Backend\RolesController@index'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /roles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        Role::destroy( $id );

        flash()->success('The role was successfully deleted');

        return redirect(action('Backend\RolesController@index'));
    }

}
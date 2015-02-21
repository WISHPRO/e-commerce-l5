<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
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

        return view( 'backend.roles.index', compact( 'roles' ) );
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getAssignPermissions()
    {
        // now, if there are no roles or permissions, we shall bail. this makes sense
        if (empty( Role::all()->count() ) || empty( Permission::all()->count() )) {
            return Redirect::route( 'backend' )->with(
                'message',
                'you need to add both roles and permissions before assigning permissions'
            )->with( 'alertclass', 'alert-danger' );
        }

        return view( 'backend.roles.assignPermissions' );
    }

    /**
     * This will allow the admin to assign already configured permissions to
     * already configured roles
     *
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $roleID
     * @internal param $permissions
     */
    public function AssignPermissions()
    {

        // gather the inputs
        return $this->givePermissions();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function givePermissions()
    {
        $roleID = Input::get( 'role_id' );

        $permissions = Input::get( 'permissions' );

        // validate..obviously
        $validator = Validator::make( $data = Input::all(), Role::$assignment_rules );
        if ($validator->fails()) {

            return Redirect::back()->withErrors( $validator )->withInput()->with(
                'message',
                "please ensure that you've selected both a role and a permission, to proceed"
            )->with( 'alertclass', 'alert-danger' );
        } else {
            // find the role
            $role = Role::find( $roleID );

            // then assign it permissions using the means described by entrust
            $role->perms()->sync( $permissions );

            return Redirect::route( 'backend' )->with(
                'message',
                'successfully assigned the specified permissions to the role'
            )->with( 'alertclass', 'alert-success' );

        }
    }

    /**
     * Displays the form to allow the admin to assign a role to a user
     *
     * @return \Illuminate\View\View
     */
    public function getAssignRolesToUsers()
    {

        return view( 'backend.roles.assignUsers' );
    }

    /**
     * Allows an admin to assign a role to a user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AssignRolesToUsers()
    {
        // gather the inputs

        return $this->doAssignRole();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function doAssignRole()
    {
        $roleID = Input::get( 'role_id' );
        $userID = Input::get( 'user_id' );

        // validate..obviously

        $validator = Validator::make( $data = Input::all(), Role::$user_assignment_rules );

        if ($validator->fails()) {
            return Redirect::back()->withErrors( $validator )->withInput()->with(
                'message',
                $this->FormErrorMsg
            )->with( 'alertclass', 'alert-danger' );
        } else {

            // find the user
            $user = User::find( $userID );

            // check if the user already has the specified role
            if ($user->hasRole( Role::find( $roleID )->name )) {
                return Redirect::back()->with( 'message', 'This user already has this role' )->with(
                    'alertclass',
                    'alert-info'
                );
            }

            // assign the user the role
            $user->roles()->attach( $roleID );

            return Redirect::route( 'backend' )->with(
                'message',
                'successfully assigned user with id ' . $userID . ' to the role'
            )->with( 'alertclass', 'alert-success' );
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getRevoke()
    {
//        $users = User::with('roles')->get();
//
//        if (empty($users))
//            return Redirect::route('backend')->with('message', 'no users have been configured with any roles')->with('alertclass', 'alert-danger');
//        return view('backend.roles.revokeRoles', compact('users'));
        return 'Not implemented Yet';
    }

    public function Revoke()
    {

        return $this->doRevokeRole();

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function doRevokeRole()
    {
        $userID = Input::get( 'user_id' );

        $user = User::find( $userID );

        $roles = Input::get( 'roles' );

        // validate..obviously
        $validator = Validator::make( $data = Input::all(), Role::$assignment_rules );
        if ($validator->fails()) {

            return Redirect::back()->withErrors( $validator )->withInput()->with(
                'message',
                $this->FormErrorMsg
            )->with( 'alertclass', 'alert-danger' );
        }

        foreach ($roles as $role) {
            if ($user->hasRole( $role->name )) {
                // then, revoke it
            }
        }

        return Redirect::route( 'backend' )->with(
            'message',
            'successfully assigned the specified permissions to the role'
        )->with( 'alertclass', 'alert-success' );
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
    public function store()
    {
        $validator = Validator::make( $data = Input::all(), Role::$rules );
        $role = new Role();
        $role->name = Input::get( 'name' );

        if (!$validator->fails()) {
            Role::create( $data );

            return Redirect::route( 'roles.view' )->with(
                'message',
                'success. Now, you just need to assign system users to this role'
            )->with( 'alertclass', 'alert-success' );
        }

        return Redirect::back()->withErrors( $validator )->withInput()->with( 'message', $this->FormErrorMsg )->with(
            'alertclass',
            'alert-danger'
        );
    }

    public function Assign( $role_id, $user_id )
    {

        // find the user
        $user = User::findOrFail( $user_id );

        // attach the role
        $user->roles()->attach( $role_id );

        return view( 'backend.roles.assign' );

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

        return view( 'backend.roles.edit', compact( 'role' ) );
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

        return view( 'backend.roles.edit', compact( 'role' ) );
    }

    /**
     * Update the specified resource in storage.
     * PUT /roles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( $id )
    {
        $role = Role::findOrFail( $id );

        $validator = Validator::make( $data = Input::all(), Role::$rules );

        if ($validator->fails()) {
            return Redirect::back()->withErrors( $validator )->withInput()->with(
                'message',
                $this->FormErrorMsg
            )->with( 'alertclass', 'alert-danger' );
        }

        $role->update( $data );

        return Redirect::route( 'roles.view' )->with( 'message', 'successfully updated role with id ' . $id )->with(
            'alertclass',
            'alert-success'
        );
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

        return Redirect::route( 'roles.view' )->with( 'message', 'successfully deleted role with id ' . $id )->with(
            'alertclass',
            'alert-success'
        );
    }

}
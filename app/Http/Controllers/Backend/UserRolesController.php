<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AssignRolesRequest;
use app\Models\Role;
use app\Models\User;
use Illuminate\Http\Response;

class UserRolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // display all users, who have been assigned roles

    }

    /**
     * assign a role to a user
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.Acl.assignRoles');
    }

    /**
     * Assign a role to a user
     *
     * @return Response
     */
    public function store(AssignRolesRequest $request)
    {
        // find the user
        $user = User::find($request->get('user_id'));

        // check if the user already has the specified role
        if ($user->hasRole(Role::find($request->get('role_id'))->name)) {
            flash('This user already has this role');
            redirect()->back();
        }

        // assign the user the role
        $user->roles()->attach($request->get('role_id'));

        flash()->success('Role was successfully assigned');

        return redirect(action('Backend\UserRolesController@view'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(AssignRolesRequest $request, $id)
    {
        // form to modify a user's role
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id)
    {
        // edit a user's role
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}

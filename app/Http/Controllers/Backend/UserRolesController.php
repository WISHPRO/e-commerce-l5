<?php namespace app\Http\Controllers\Backend;

use app\Anto\DomainLogic\repositories\Security\RolesRepository;
use app\Anto\DomainLogic\repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AssignRolesRequest;
use app\Models\Role;
use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserRolesController extends Controller
{
    protected $role;

    protected $user;

    /**
     * @param RolesRepository $rolesRepository
     * @param UserRepository $userRepository
     *
     */
    public function __construct(RolesRepository $rolesRepository, UserRepository $userRepository)
    {
        $this->role = $rolesRepository;

        $this->user = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // display all users, who have been assigned roles
        $users = $this->user->has('roles', true);

        return view('backend.Access-control.index', compact('users'));
    }

    /**
     * assign a role to a user
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.Access-control.assignRoles');
    }

    /**
     * Assign roles to a user
     *
     * @return Response
     */
    public function store(AssignRolesRequest $request)
    {
        $result = $this->role->assign($request->get('user_id'), $request->get('role_id'));

        flash()->success('The role has been assigned successfully');

        return redirect()->action('Backend\UserRolesController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // get a user and their roles
        $user = $this->user->getFirstBy('id', '=', $id, ['roles']);

        return view('backend.Access-control.RevokeRoles', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // edit a user's role
        $this->role->revoke($id, $request->get('roles'));
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

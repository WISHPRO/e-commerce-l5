<?php namespace app\Http\Controllers\Backend;

use app\Anto\DomainLogic\repositories\Security\RolesRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AssignRolesRequest;
use app\Models\Role;
use app\Models\User;
use Illuminate\Http\Response;

class UserRolesController extends Controller
{
    protected $role;

    public function __construct(RolesRepository $rolesRepository)
    {
        $this->role = $rolesRepository;
    }

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
        $result = $this->role->assign($request->user()->id, $request->get('role_id'));

        if ($result == -1) {
            flash('The specified user already has been assigned that role');

            return redirect()->back();
        }

        flash()->success('The role has been assigned successfully');

        return redirect()->back();
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

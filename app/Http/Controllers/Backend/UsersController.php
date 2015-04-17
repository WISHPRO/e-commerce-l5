<?php namespace App\Http\Controllers\Backend;

use app\Antony\DomainLogic\Modules\User\Base\Users;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserAccountRequest;
use App\Http\Requests\User\DeleteUsrRequest;
use App\Models\User;

class UsersController extends Controller
{

    /**
     * @param Users $users
     */
    public function __construct(Users $users)
    {
        $this->user = $users;
    }


    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->user->get();

        return view('backend.Users.index', compact('users'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.Users.create');
    }


    /**
     * @param CreateUserAccountRequest $accountRequest
     */
    public function store(CreateUserAccountRequest $accountRequest)
    {
        $this->user->create($accountRequest->except('accept'))->handleRedirect($accountRequest);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->user->retrieve($id);

        return view('backend.Users.edit', compact('user'));
    }


    /**
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->user->retrieve($id);

        return view('backend.Users.edit', compact('user'));
    }

    /**
     * @param CreateUserAccountRequest $request
     * @param $id
     */
    public function update(CreateUserAccountRequest $request, $id)
    {
        $this->user->edit($id, $request->all())->handleRedirect($request);
    }

    /**
     * @param DeleteUsrRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(DeleteUsrRequest $request, $id)
    {
        return $this->user->delete($id)->handleRedirect($request);
    }

}
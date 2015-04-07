<?php namespace App\Http\Controllers\Backend;

use app\Antony\DomainLogic\Modules\User\Base\Users;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Response;

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
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->get();

        return view('backend.Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
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
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request, $id)
    {
        return $this->user->delete($id)->handleRedirect($request);
    }

}
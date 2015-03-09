<?php namespace app\Http\Controllers\Backend;

use app\Anto\DomainLogic\repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Registrar;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Response;

class UsersController extends Controller
{

    private $user = null;

    public function __construct(Guard $auth, Registrar $registrar, UserRepository $repository)
    {
        $this->auth = $auth;

        $this->registrar = $registrar;

        $this->user = $repository;
    }

    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->paginate(['counties'], 10);

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
    public function store(Request $request)
    {

        $validator = $this->registrar->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request,
                $validator
            );
        }

        $this->registrar->create($request->all());

        flash()->success('User successfully created');

        return redirect(action('UsersController@index'));
    }

    /**
     * Display the specified resource.
     * GET /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        return view('backend.Users.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /users/{id}/edit
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('backend.Users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user->find($id);

        $user->modify($request->all());

        flash()->success('user was successfully updated');

        return redirect(action('UsersController@index'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->user->delete([$id]);

        flash()->success('successfully deleted user with id ' . $id);

        return redirect(action('Backend\UsersController@index'));
    }

}
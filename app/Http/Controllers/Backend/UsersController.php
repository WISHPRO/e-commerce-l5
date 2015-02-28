<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Registrar;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Response;

class UsersController extends Controller
{

    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;

        $this->registrar = $registrar;
    }

    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        $users = User::with('county')->paginate(10);

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
        $user = User::find($id);

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
        $user = User::findOrFail($id);

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
        $user = User::findOrFail($id);

        $user->update($request->all());

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
        User::destroy($id);

        flash()->success('successfully deleted user with id '.$id);

        return redirect(action('Backend\UsersController@index'));
    }

}
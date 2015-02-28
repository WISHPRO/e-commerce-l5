<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Response;

class UsersController extends Controller
{

    /* This would allow users to register, and change/view selected aspects about themselves */

    /**
     * Display a user's profile
     * GET /users
     *
     * @return Response
     */
    public function index($id)
    {
        // gather simple user info, from the user's table, and return it
        $user = User::find($id);

        return view('frontend.users.index', compact('user'));
    }

    /**
     * This will just allow an anonymous user to create an account
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
        return view('frontend.users.register');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * This will allow users to be able to delete their account
     * DELETE /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // very destructive indeed
    }

}
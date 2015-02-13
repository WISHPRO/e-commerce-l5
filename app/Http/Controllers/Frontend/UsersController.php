<?php

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;

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

        return View::make('frontend.users.index', compact('user'));
    }

    /**
     * This will just allow an anonymous user to create an account
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('frontend.users.register');
    }

    /**
     * Process a POST request from an anonymous user, regarding registration
     * POST /users
     *
     * @return Response
     */
    public function store(RegisterUserRequest $request)
    {
        $user = new User();
        // check if the user requested to be logged in after creating an account
        $firstTimeLogin = $request->get('logMeIn') === "Yes";
        // create the account, ie register the user
        if ($user->save()) {

            // we only log in the user, if they requested to

            if ($firstTimeLogin) {

                if (Auth::attempt(['email' => $user->email, 'password' => $user->password]))

                    return Redirect::intended('/')
                        ->with('message', 'Your account was successfully created ' . $m = "we've also logged you in" ? $firstTimeLogin : "")
                        ->with('alertclass', 'alert-success');
            }
        }
    }

    /**
     * Display the specified resource.
     * GET /users/{id}
     *
     * @param  int $id
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
     * @return Response
     */
    public function destroy($id)
    {
        // very destructive indeed
    }

}
<?php

use App\Http\Controllers\Controller;

class BackendUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        $users = User::with('county')->paginate(10);

        return View::make('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function store()
    {
        return $this->doCreateUser();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function doCreateUser()
    {
        // create the user
        $user = new User();

        if (!$user->save(User::$rules)) {
            return Redirect::back()->withErrors($user->errors())->withInput()->with('message', 'please fix the errors in your form and try again')->with('alertclass', 'alert-danger');
        }

        return Redirect::route('users.view')->with('message', 'Successfully created the user')->with('alertclass', 'alert-success');
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
        return $this->doUpdate($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    private function doUpdate($id)
    {
        $user = User::findOrFail($id);

        // reset the password rules, if the admin only plans to edit other fields
        if ($user->exists) {
            User::$rules['password'] = (Input::get('password')) ? 'required|confirmed' : '';
            User::$rules['password_confirmation'] = (Input::get('password_confirmation')) ? 'required' : '';
        }

        // now we validate the user
        if ($user->validate(User::$rules)) {

            return Redirect::back()->withErrors($user->errors())->withInput()->with('message', "check your inputs and try again")->with('alertclass', 'alert-danger');
        }

        $user->user_name = Input::get('user_name');
        $user->email_address = Input::get('email_address');
        $user->employee_id = Input::get('employee_id');
        $user->phone = Input::get('phone');
        $user->county = Input::get('county');
        $user->home_address = Input::get('home_address');
        $user->town = Input::get('town');

        // update uniques from the lovely ardent package will sort issues with unique values
        if ($user->updateUniques(User::$rules)) {
            // successful update
            return Redirect::back()->with('message', 'successfully updated the user')->with('alertclass', 'alert-success');
        } else {
            // unsuccessful update
            return Redirect::back()->with('message', 'an error occurred. please try again later')->with('alertclass', 'alert-danger');
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
        $data = User::find($id);
        return View::make('backend.profile.index', compact('data'));
    }

    /** Allow the admin to view their profile
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {

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
        $user = User::find($id);
        return View::make('backend.Users.edit', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /users/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Auth::id() === $id)
        {
            return Redirect::back()->with('message', 'Administrator!. you are not allowed to delete your own account')->with('alertclass', 'alert-danger');
        }
        if(User::destroy($id) === 1)
        {
            return Redirect::route('users.view')->with('message', 'successfully deleted user with id ' . $id)->with('alertclass', 'alert-success');
        }
        else
        {
            return Redirect::back()->with('message', $this->errorMsg)->with('alertclass', 'alert-danger');
        }

    }

}
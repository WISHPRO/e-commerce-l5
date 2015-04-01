<?php namespace App\Http\Controllers\Shared;

use App\Antony\DomainLogic\Modules\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Response;

class AccountController extends Controller
{

    protected $user;

    protected $auth;

    protected $hash;

    /**
     * @param UserRepository $repository
     * @param Guard $auth
     * @param Hasher $hasher
     */
    public function __construct(UserRepository $repository, Guard $auth, Hasher $hasher)
    {
        $this->user = $repository;

        $this->auth = $auth;

        $this->hash = $hasher;
    }

    /* This would allow users to register, and change/view selected aspects about themselves */

    /**
     * Display a user's profile
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        $user = $this->user->with(['county', 'shopping_cart'])->where('id', '=', $this->auth->id())->get()->first();

        return view('shared.Account.index', compact('user'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contact(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email|max:255|unique:users,id,' . $this->auth->id(),
                'phone' => 'required|digits:9|unique:users,id,' . $this->auth->id(),
            ]
        );

        if ($this->user->update($request->all(), $this->auth->id())) {

            flash()->success('Your contact information was successfully updated');

            return redirect()->back();
        }

        flash()->error('Update failed. Please try again later');

        return redirect()->back();

    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request)
    {
        $this->validate(
            $request,
            [
                'password' => 'required|between:3,30|alpha_num|confirmed',
            ]
        );

        // retrieve old password
        $oldPass = $this->auth->user()->getAuthPassword();

        // we do not need to hash a password if it is similar to the old one
        if (!$this->hash->check($request->get('password'), $oldPass)) {
            // update user's password

            $user = $this->user->find($request->user()->id);

            $user->password = $this->hash->make($request->get('password'));

            $user->save();

            flash()->success('Your password was successfully changed');

            // the user requested to log-out, so we return the favour
            if ($request->has('logMeOut')) {

                $this->auth->logout();

                flash('Please login to continue:');

                return redirect()->route('login');
            }

            return redirect()->back();
        }

        flash()->warning('Your password was not changed, since it is similar to your old one');

        return redirect()->back();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function delete()
    {
        return view('shared.Account.delete');
    }

    /**
     * Update the specified resource in storage.
     * PUT /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(UserRequest $request)
    {
        $user = $this->user->find($this->auth->id());

        if ($user->update($request->all()) == 1) {
            flash()->success('Your account was successfully updated');

            return redirect()->back();
        }
        flash()->error('An error occurred. Please try again later');

        return redirect()->back();
    }

    /**
     * This will allow users to be able to delete their account
     * DELETE /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy()
    {
        $this->user->delete($this->auth->id());

        $this->auth->logout();

        flash('Your account was successfully deleted');

        return redirect()->route('home');
    }

}
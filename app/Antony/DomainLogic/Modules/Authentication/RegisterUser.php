<?php namespace app\Antony\DomainLogic\Modules\Authentication;

use app\Antony\DomainLogic\Modules\Authentication\Base\ApplicationAuthProvider;

class RegisterUser extends ApplicationAuthProvider
{

    private $user;

    /**
     * Handle a redirect after successful user registration
     *
     * @param $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function handleRedirect($request)
    {

        if ($request->ajax()) {

            if (is_null($this->user)) {
                return response()->json(['message' => 'Account creation failed. Please try again'], 422);
            }
            return response()->json(['message' => 'Your account was successfully created. Check your email address for an activation email']);
        } else {

            if (is_null($this->user)) {

                flash()->error('Account creation failed. Please try again');
                return redirect($this->redirectPath())->withInput($request->all());
            } else {
                flash()->overlay('Your account was successfully created. Check your email address for an activation email');

                return redirect($this->redirectPath());
            }

        }
    }

    /**
     * Create a new user account
     *
     * @param array $data
     *
     * @return $this
     */
    public function register(array $data)
    {
        $this->user = $this->userRepository->add($data);

        return $this;
    }
}
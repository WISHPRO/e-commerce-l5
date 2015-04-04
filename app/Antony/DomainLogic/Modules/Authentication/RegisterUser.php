<?php namespace app\Antony\DomainLogic\Modules\Authentication;

use app\Antony\DomainLogic\Contracts\Security\AuthStatus;
use app\Antony\DomainLogic\Modules\Authentication\Base\ApplicationAuthProvider;
use App\Antony\DomainLogic\Modules\Authentication\Traits\AccountActivationTrait;
use App\Events\UserWasRegistered;
use Illuminate\Http\Request;
use InvalidArgumentException;

class RegisterUser extends ApplicationAuthProvider
{

    use AccountActivationTrait;

    protected $user;

    protected $mailResponse;

    /**
     * Handle a redirect after successful user registration
     *
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function handleRedirect($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }

        switch ($this->authStatus) {

            case AuthStatus::ACCOUNT_CREATED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your account was successfully created. Check your email address for an activation email', 'target' => url($this->redirectPath())]);
                } else {

                    flash('Your account was successfully created. Check your email address for an activation email');

                    return redirect($this->redirectPath());

                }
            }
            case AuthStatus::ACCOUNT_NOT_CREATED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Account creation failed. Please try again'], 422);
                } else {

                    flash()->error('Account creation failed. Please try again');

                    return redirect($this->redirectPath())->withInput($request->all());
                }
            }
        }
        return redirect()->back()->withInput($request->all());

    }

    /**
     * Triggers the mail send event
     *
     * @return $this
     */
    public function sendRegistrationEmail()
    {
        if (is_null($this->user)) {
            throw new InvalidArgumentException('A user needs to be created first');

        }
        $this->mailResponse = event(new UserWasRegistered($this->user));

        return $this;
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
        $this->user = $this->registrar->create($data);

        if (is_null($this->user)) {

            $this->authStatus = AuthStatus::ACCOUNT_NOT_CREATED;

            return $this;
        }

        $this->authStatus = AuthStatus::ACCOUNT_CREATED;

        return $this;
    }
}
<?php namespace app\Antony\DomainLogic\Modules\Authentication;

use app\Antony\DomainLogic\Contracts\Security\UserRegistrationContract;
use app\Antony\DomainLogic\Modules\Authentication\Base\ApplicationAuthProvider;
use App\Antony\DomainLogic\Modules\Authentication\Traits\AccountActivationTrait;
use App\Events\UserWasRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use InvalidArgumentException;

class RegisterUser extends ApplicationAuthProvider implements UserRegistrationContract
{
    // allows users to activate their accounts
    use AccountActivationTrait;

    /**
     * The user created
     *
     * @var User
     */
    protected $user;

    /**
     * Response returned after sending registration email
     *
     * @var array
     */
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

            case static::ACCOUNT_CREATED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your account was successfully created. Check your email address for an activation email', 'target' => url($this->redirectPath())]);
                } else {

                    flash('Your account was successfully created. Check your email address for an activation email');

                    return redirect($this->redirectPath());

                }
            }
            case static::ACCOUNT_CREATED_WITHOUT_ACTIVATION: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your account was successfully created. Please login to continue', 'target' => url($this->redirectPath())]);
                } else {

                    flash('Your account was successfully created. Please login to continue');

                    return redirect($this->redirectPath());

                }
            }
            case static::ACCOUNT_NOT_CREATED: {
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
     * Triggers the registration mail send event
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
     * Create a new user account, with an option to allow the user to activate it before use
     *
     * @param array $data
     *
     * @param bool $enforceActivation
     *
     * @return $this
     */
    public function register(array $data, $enforceActivation = true)
    {
        $this->user = $this->userRepository->createAccount($data, $enforceActivation);

        if (is_null($this->user)) {

            $this->setAuthStatus(static::ACCOUNT_NOT_CREATED);

            return $this;
        }

        $enforceActivation ? $this->setAuthStatus(static::ACCOUNT_CREATED_WITHOUT_ACTIVATION) : $this->setAuthStatus(static::ACCOUNT_CREATED);

        return $this;
    }
}
<?php namespace app\Antony\DomainLogic\Modules\Authentication\Base;

use app\Antony\DomainLogic\Contracts\Security\AuthContract;
use App\Antony\DomainLogic\Modules\User\UserRepository;
use App\Services\Registrar;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Laravel\Socialite\Contracts\Factory as Socialite;

abstract class ApplicationAuthProvider implements AuthContract
{

    /**
     * Flag to indicate if the request is from/to the backend
     *
     * @var boolean
     */
    public $backend = false;

    /**
     * Status of an authentication request. For non API calls only
     *
     * @var string
     */
    protected $authStatus;

    /**
     * Socialite implementation
     *
     * @var Socialite
     */
    protected $socialite;

    /**
     * Authenticator implementation
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The socialite driver, ie an API name, like facebook, google, etc
     *
     * @var string
     */
    protected $driver;

    /**
     * Our user repo
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * The registrar class
     *
     * @var Registrar
     */
    protected $registrar;

    /**
     * The password broker implementation
     *
     * @var PasswordBroker
     */
    protected $passwords;

    /**
     * @param Socialite $socialite
     * @param Guard $guard
     * @param UserRepository $userRepository
     * @param Registrar $registrar
     * @param PasswordBroker $passwords
     */
    public function __construct(Socialite $socialite, Guard $guard, UserRepository $userRepository, Registrar $registrar, PasswordBroker $passwords)
    {

        $this->socialite = $socialite;
        $this->auth = $guard;
        $this->userRepository = $userRepository;
        $this->registrar = $registrar;
        $this->passwords = $passwords;
    }

    /**
     * Provides authentication/registration functionality via API calls
     *
     * @param $code_present
     * @param $api_name
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function AuthenticateViaAPI($code_present, $api_name)
    {
        $this->driver = $api_name;

        if (!$code_present) {

            return $this->getAuthorizationFirst();
        } else {

            $user = $this->userRepository->findByEmailOrCreateNew($this->getApiUser());

            // login the user to our site
            $this->auth->login($user, true);

            return redirect()->to($this->redirectPath());
        }

    }

    /**
     * Redirects the user to the API login page
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function getAuthorizationFirst()
    {
        return $this->socialite->driver($this->driver)->redirect();
    }

    /**
     * Returns the user data from an api call
     *
     * @return \Laravel\Socialite\Contracts\User
     */
    protected function getApiUser()
    {

        return $this->socialite->driver($this->driver)->user();
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        if ($this->backend) {
            return property_exists($this, 'redirectTo') ? $this->redirectTo : '/backend';
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    /**
     * Returns the status of an authentication request
     *
     * @return mixed
     */
    public function getAuthStatus()
    {
        return $this->authStatus;
    }

    /**
     * @param string $authStatus
     */
    protected function setAuthStatus($authStatus)
    {
        $this->authStatus = $authStatus;
    }

    /**
     * Allow a user to login into the application. The redirects need to be processed anyway, since it returns itself
     *
     * @param array $credentials
     *
     * @return $this
     */
    public function login(array $credentials)
    {
        // authenticate user
        if ($this->auth->attempt(array_except($credentials, "remember"), array_has($credentials, 'remember'))) {

            if (config('site.account.login_when_inactive')) {

                $this->authStatus = $this->checkIfAccountIsConfirmed();

                return $this;
            }

            $this->setAuthStatus(AuthContract::LOGIN_SUCCESS);

            return $this;

        } else {

            $this->setAuthStatus(AuthContract::LOGIN_FAILED);

            return $this;
        }
    }

    /**
     * Check if a users account is activated/confirmed
     *
     * @return string
     */
    public function checkIfAccountIsConfirmed()
    {
        // retrieve the authenticated user and check if their account is activated/confirmed
        if ($this->auth->user()->confirmed) {

            $this->setAuthStatus(AuthContract::ACCOUNT_ACTIVATED);

            return $this->authStatus;
        } else {

            $this->setAuthStatus(AuthContract::NOT_ACTIVATED);

            return $this->authStatus;
        }

    }

    /**
     * Log out a user, and redirect them to the set logout path
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->auth->logout();

        return redirect()->to($this->logoutPath());
    }

    /**
     * Get the path to the logout route.
     *
     * @return string
     */
    public function logoutPath()
    {
        if ($this->backend) {

            return property_exists($this, 'logoutPath') ? $this->loginPath : '/backend/login';
        }
        return property_exists($this, 'logoutPath') ? $this->loginPath : '/';
    }

    /**
     * Handle a redirect, after successful login or etc. This can be overriden though
     *
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleRedirect($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        if (is_null($this->authStatus)) {
            throw new InvalidArgumentException('You need to try and attempt to login the user first');
        }

        $isAJAX = $request->ajax();

        switch ($this->authStatus) {
            case AuthContract::LOGIN_SUCCESS: {

                return $isAJAX ? response()->json(['target' => secure_url(session('url.intended', $this->redirectPath()))]) : redirect()->intended($this->redirectPath());
            }
            case AuthContract::LOGIN_FAILED: {
                // check if the request is AJAX and do the necessary
                if ($isAJAX) {
                    return response()->json(['message' => 'Invalid email/password combination. Please try again, and check if you\'ve enabled caps lock'], 401);
                } else {
                    flash()->error('Invalid email/password combination. Please try again, and check if you\'ve enabled caps lock');

                    return redirect($this->loginPath())->withInput(
                        $request->only('email', 'remember')
                    );
                }
            }
            case AuthContract::ACCOUNT_ACTIVATED: {
                if ($isAJAX) {
                    return response()->json(['target' => secure_url(session('url.intended', $this->redirectPath()))]);
                } else {
                    return redirect()->intended($this->redirectPath());
                }

            }
            case AuthContract::NOT_ACTIVATED: {
                // account is not confirmed
                if ($isAJAX) {
                    return response()->json(['message' => 'Your account has not been activated. You need to activate your account before using it'], 401);
                } else {
                    flash('Your account has not been activated. You need to activate your account before using it');
                    return redirect($this->loginPath())->withInput(
                        $request->only('email', 'remember')
                    );
                }
            }
        }
        return redirect()->to($this->loginPath());
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        if ($this->backend) {

            return property_exists($this, 'loginPath') ? $this->loginPath : '/backend/login';
        }
        return property_exists($this, 'loginPath') ? $this->loginPath : '/account/login';
    }
}
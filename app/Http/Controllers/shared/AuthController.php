<?php namespace App\Http\Controllers\Shared;

use app\Antony\DomainLogic\Modules\Authentication\AuthenticateUser;
use app\Antony\DomainLogic\Modules\Authentication\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Counties\LoginRequest;
use App\Http\Requests\User\CreateUserAccountRequest;
use app\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{

    /**
     * @var AuthenticateUser
     */
    protected $auth;

    /**
     * @var RegisterUser
     */
    private $registrar;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param AuthenticateUser $authenticateUser
     * @param RegisterUser $registerUser
     * @param Request $request
     */
    public function __construct(AuthenticateUser $authenticateUser, RegisterUser $registerUser, Request $request)
    {
        $this->middleware('guest', ['except' => 'getLogout', 'getActivate']);

        $this->auth = $authenticateUser;
        $this->request = $request;
        $this->auth->backend = $this->request->segment(1) === 'backend' ? true : false;
        $this->registrar = $registerUser;

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        if ($this->auth->backend) {
            return view('backend.Auth.login');
        }
        return view('auth.login');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }


    /**
     * login via an API
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     */
    public function apiLogin(Request $request)
    {
        return $this->auth->AuthenticateViaAPI($request->get('code'), $request->get('api', 'facebook'));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function apiRegistration(Request $request)
    {
        return $this->auth->AuthenticateViaAPI($request->get('code'), $request->get('api', 'facebook'));
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        return $this->auth->logout();
    }

    /**
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postLogin(LoginRequest $request)
    {
        return $this->auth->login($request->except('_token'))->handleRedirect($request);
    }

    /**
     * @param CreateUserAccountRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function postRegister(CreateUserAccountRequest $request)
    {
        return $this->registrar->register($request->except('_token'))->sendRegistrationEmail()->handleRedirect($request);
    }

    /**
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getActivate($code)
    {
        if (is_null($code)) {

            throw new NotFoundHttpException('An activation code is required, but was not found');
        }
        return $this->registrar->activate($code);
    }
}

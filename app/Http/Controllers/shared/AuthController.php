<?php namespace App\Http\Controllers\Shared;

use App\Antony\DomainLogic\Modules\Authentication\AccountActivationTrait;
use app\Antony\DomainLogic\Modules\Authentication\AuthenticateUser;
use app\Antony\DomainLogic\Modules\Authentication\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Counties\LoginRequest;
use App\Http\Requests\User\UserCreateAccountRequest;
use app\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    use AccountActivationTrait;

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
        if($this->auth->backend){
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
     * @param Request $request
     * @param $api
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function apiLogin(Request $request, $api)
    {
        return $this->auth->execute($request->get('code'), $api);
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
     * @return $this|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postLogin(LoginRequest $request)
    {
        return $this->auth->login($request->except('_token'))->handleRedirect($request);
    }

    /**
     * @param UserCreateAccountRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function postRegister(UserCreateAccountRequest $request)
    {
        return $this->registrar->register($request->except('_token'))->handleRedirect($request);
    }
}

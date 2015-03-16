<?php namespace app\Http\Controllers\Auth;

use app\Anto\DomainLogic\repositories\User\UserRepository;
use app\Anto\domainLogic\Traits\Auth\ClientAuth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ClientAuth;


    /**
     * @param Guard $auth
     * @param Registrar $registrar
     */
    public function __construct(Guard $auth, Registrar $registrar, UserRepository $userRepository)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->user = $userRepository;

        $this->middleware('guest', ['except' => 'getLogout, getActivate']);
    }

}

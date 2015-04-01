<?php namespace App\Http\Controllers\Auth;

use App\Antony\DomainLogic\Modules\Authentication\AccountActivationTrait;
use App\Antony\DomainLogic\Modules\Authentication\ClientAuthenticationTrait;
use App\Antony\DomainLogic\modules\User\UserRepository;
use App\Http\Controllers\Controller;
use app\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

class AuthController extends Controller
{

    use ClientAuthenticationTrait, AccountActivationTrait;

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;

    /**
     * User repository implementation
     *
     * @var User
     */
    protected $user;

    /**
     * @param Guard $auth
     * @param Registrar $registrar
     * @param UserRepository $userRepository
     */
    public function __construct(Guard $auth, Registrar $registrar, UserRepository $userRepository)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->user = $userRepository;

        $this->middleware('guest', ['except' => 'getLogout', 'getActivate']);
    }

}

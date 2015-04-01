<?php namespace App\Http\Controllers\Auth\Backend;

use App\Antony\DomainLogic\Modules\Authentication\backendAuthenticationTrait;
use App\Http\Controllers\Controller;
use app\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

class AuthController extends Controller
{

    use backendAuthenticationTrait;

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
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

}
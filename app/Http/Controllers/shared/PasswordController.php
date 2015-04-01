<?php namespace App\Http\Controllers\Shared;

use App\Antony\DomainLogic\Modules\Authentication\ResetPasswordsTrait;
use App\Antony\DomainLogic\Modules\User\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\UserProvider;

class PasswordController extends Controller
{

    use ResetPasswordsTrait;

    /**
     * @param Guard $auth
     * @param PasswordBroker $passwords
     * @param UserProvider $users
     */
    public function __construct(Guard $auth, PasswordBroker $passwords, UserRepository $users)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;
        $this->user = $users;
        $this->middleware('guest');
    }

}

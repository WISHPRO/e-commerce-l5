<?php namespace app\Http\Controllers\Shared;

use App\Antony\DomainLogic\Modules\Authentication\ResetPasswordsTrait;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;

class PasswordController extends Controller
{

    use ResetPasswordsTrait;

    /**
     * @param Guard $auth
     * @param PasswordBroker $passwords
     */
    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;

        $this->middleware('guest');
    }

}

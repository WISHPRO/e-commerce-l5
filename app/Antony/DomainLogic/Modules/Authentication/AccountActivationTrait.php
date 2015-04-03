<?php namespace App\Antony\DomainLogic\Modules\Authentication;

use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait AccountActivationTrait
{

    /**
     * Activate a user's account
     *
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getActivate($code)
    {
        if (is_null($code)) {

            throw new NotFoundHttpException();
        }

        return $this->activate($code);
    }

    /**
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($code)
    {
        // activate a user's account
        $user = $this->verifyCode($code);

        // check if we need to automatically sign in a user, once they activate their account
        $autoLogin = config('site.account.auto_login_on_activate', false);

        flash()->overlay('Your account was successfully activated. You are now a member at PC-World!.' . $autoLogin ? "" : " Please login to continue");

        // really not necessary, so i just pushed it to config, just in case its needed
        if ($autoLogin) {
            $this->auth->login($user);

            return redirect()->intended($this->redirectPath());
        } else {

            return redirect()->route('login');
        }

    }

    /**
     * Verify an activation code
     *
     * @param $code
     *
     * @return mixed
     */
    public function verifyCode($code)
    {
        // verify that this confirmation code matches the user
        $user = $this->user->where('confirmation_code', '=', $code)->first();

        // check if the result is valid
        if (is_null($user)) {

            throw new NotFoundHttpException('A user matching that confirmation code was not found');
        }

        // update necessary fields and save the user model
        $user->confirmation_code = null;

        $user->confirmed = true;

        $user->save();

        return $user;
    }
}
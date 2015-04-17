<?php namespace app\Antony\DomainLogic\Modules\Authentication\Traits;

trait api_authentication
{

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


}
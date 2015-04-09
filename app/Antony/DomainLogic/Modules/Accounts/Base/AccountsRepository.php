<?php namespace app\Antony\DomainLogic\Modules\Accounts\Base;

use app\Antony\DomainLogic\Contracts\Account\AccountsContract;
use app\Antony\DomainLogic\Contracts\Redirects\AppRedirector;
use App\Antony\DomainLogic\Modules\User\UserRepository;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class AccountsRepository implements AccountsContract, AppRedirector
{

    /**
     * Flag to indicate if the request is from/to the backend
     *
     * @var boolean
     */
    public $backend = false;

    /**
     * Results from a account audit attempt
     *
     * @var string
     */
    protected $result;

    /**
     * The authenticator implementation
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The user repo
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * The hasher implementation
     *
     * @var Hasher
     */
    protected $hasher;

    /**
     * The user object
     *
     * @var User
     */
    protected $user;

    /**
     * @param Guard $guard
     * @param UserRepository $userRepository
     * @param Hasher $hasher
     */
    public function __construct(Guard $guard, UserRepository $userRepository, Hasher $hasher)
    {

        $this->auth = $guard;
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;

        $this->retrieveAuthenticatedUser();
    }

    /**
     * Retrieves the authenticated user
     *
     * @return User|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|mixed|null|static
     */
    protected function retrieveAuthenticatedUser()
    {
        $this->user = $this->auth->user();

        // This will be so rare, but anyway..
        if (is_null($this->user)) {

            throw new HttpResponseException(new Response('Access denied', 401));
        }
        return $this->user;
    }

    /**
     * Retrieves user account data
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUserData()
    {
        return $this->userRepository->getFirstBy('id', '=', $this->user->id, ['county', 'shopping_cart']);
    }

    /**
     * Allows a user to update all their account data at once
     *
     * @param $new_data
     *
     * @return $this
     */
    public function updateAccountData($new_data)
    {
        // dob
        if (array_has($new_data, 'dob')) {
            $data['dob'] = $this->correctDateFormat($new_data['dob']);

            $result = $this->verifyAgeBeforeSave($data['dob']);

            if ($result !== true) {

                return $result;
            }
        }

        if ($this->user->update($new_data) == 1) {

            $this->setStatusResult(AccountsContract::ACCOUNT_INFO_UPDATED);

            return $this;
        } else {

            $this->setStatusResult(AccountsContract::UPDATE_FAILED);

            return $this;
        }
    }

    /**
     * @param $dob
     *
     * @return bool|string
     */
    public function correctDateFormat($dob)
    {
        return date("Y-m-d", strtotime($dob));
    }

    /**
     * @param $dob
     *
     * @return $this|bool
     */
    private function verifyAgeBeforeSave($dob)
    {
        // fetch user's age
        $age = $this->user->checkAge($dob, true);

        if ($age >= $this->user->maxAge) {
            $this->setStatusResult(AccountsContract::OVERAGE_USER);

            return $this;
        }
        if ($age <= $this->user->minAge) {
            $this->setStatusResult(AccountsContract::UNDERAGE_USER);

            return $this;
        }
        return true;
    }

    /**
     * Sets the status of a result
     *
     * @param mixed $result
     */
    protected function setStatusResult($result)
    {
        $this->result = $result;
    }

    /**
     * Handles redirects after an action has been completed
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
        if (is_null($this->getStatusResult())) {
            throw new InvalidArgumentException('You need to try and attempt to update a detail about the user');
        }
        switch ($this->getStatusResult()) {

            case AccountsContract::PASSWORD_MATCHES_OLD: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your password was not changed, since it is similar to your old one'], 202);
                } else {
                    flash()->warning('Your password was not changed, since it is similar to your old one');

                    return redirect()->back();
                }

            }
            case AccountsContract::PASSWORD_UPDATED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your password was successfully changed']);
                } else {
                    flash('Your password was successfully changed');

                    return redirect()->back();
                }

            }
            case AccountsContract::UPDATE_FAILED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Update failed. Please try again later'], 422);
                } else {
                    flash()->error('Update failed. Please try again later');

                    return redirect()->back()->withInput($request->all());
                }

            }
            case AccountsContract::ACCOUNT_INFO_UPDATED : {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your account was successfully updated']);
                } else {
                    flash('Your account was successfully updated');

                    return redirect()->back();
                }

            }
            case AccountsContract::INVALID_PASSWORD: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'You entered an invalid password. Did you ' . link_to_route('password.reset', 'forget your password ?')], 401);
                } else {
                    flash()->error('You entered an invalid password. Did you ' . link_to_route('password.reset', 'forget your password ?'));

                    return redirect()->back();
                }
            }
            case AccountsContract::UNDERAGE_USER: {
                if ($request->ajax()) {

                    return response()->json(["message" => "Sorry. You are underage. We only allow users aged between {$this->user->minAge} and {$this->user->maxAge}"], 422);
                } else {
                    flash()->error("Sorry. You are underage. We only allow users aged between {$this->user->minAge} and {$this->user->maxAge}");

                    return redirect()->back()->withInput($request->all());
                }
            }
            case AccountsContract::OVERAGE_USER: {
                if ($request->ajax()) {

                    return response()->json(["message" => "Sorry. You are overage. We only allow users aged between {$this->user->minAge} and {$this->user->maxAge}"], 422);
                } else {
                    flash()->error("Sorry. You are overage. We only allow users aged between {$this->user->minAge} and {$this->user->maxAge}");

                    return redirect()->back()->withInput($request->all());
                }
            }
            case AccountsContract::ACCOUNT_DELETED_BY_FORCE: {

                flash('Your account was fully deleted');

                return redirect()->route('home');

            }
            case AccountsContract::ACCOUNT_DELETED: {
                flash('Your account was deleted');

                return redirect()->route('home');
            }
            case AccountsContract::DELETE_ACCOUNT_FAILED: {
                flash()->error('Account deletion failed');

                return redirect()->route('home');
            }
        }
        return redirect()->back();
    }

    /**
     * Returns the status of an action
     *
     * @return mixed
     */
    public function getStatusResult()
    {
        return $this->result;
    }

    /**
     * Allows a user to update their password, with an option to log them out when they finish
     *
     * @param $new_password
     * @param bool $logOutWhenDone
     *
     * @return $this
     */
    public function updatePassword($new_password, $logOutWhenDone = false)
    {
        // retrieve old password
        $oldPass = $this->user->getAuthPassword();

        // we do not need to hash a password if it is similar to the old one
        if (!$this->hasher->check($new_password, $oldPass)) {
            // update user's password

            $this->user->password = $this->hasher->make($new_password);

            $result = $this->user->save();

            if ($result === false) {
                $this->setStatusResult(AccountsContract::PASSWORD_UPDATE_FAILED);
            }
            $this->setStatusResult(AccountsContract::PASSWORD_UPDATED);

            // the user requested to log-out, so we return the favour
            if ($logOutWhenDone) {

                $this->auth->logout();

            }

            return $this;
        }

        $this->setStatusResult(AccountsContract::PASSWORD_MATCHES_OLD);

        return $this;
    }

    /**
     * Allows a user to delete their account. The force option can be used, if we are working with a model
     * that uses the soft deletes trait
     *
     * @param bool $force
     *
     * @return $this
     */
    public function deleteAccount($force = false)
    {
        if ($force) {

            $this->user->forceDelete();

            $this->setStatusResult(AccountsContract::ACCOUNT_DELETED_BY_FORCE);

            return $this;
        }
        if ($this->userRepository->delete([$this->user->id])) {

            $this->setStatusResult(AccountsContract::ACCOUNT_DELETED);

            return $this;
        } else {
            $this->setStatusResult(AccountsContract::DELETE_ACCOUNT_FAILED);

            return $this;
        }

    }
}
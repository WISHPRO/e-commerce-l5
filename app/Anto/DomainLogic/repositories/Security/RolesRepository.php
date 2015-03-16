<?php namespace app\Anto\DomainLogic\repositories\Security;

use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Anto\DomainLogic\repositories\User\UserRepository;
use app\Models\Role;
use Illuminate\Contracts\Auth\Guard;

class RolesRepository extends DataAccessRepository
{

    protected $auth;

    protected $user;

    public function __construct(Role $model, Guard $guard, UserRepository $userRepository)
    {
        parent::__construct($model);

        $this->user = $userRepository;
    }

    /**
     * @param $userID
     * @param $roleID
     * @return int
     */
    public function assign($userID, $roleID)
    {
        $user = $this->user->find($userID);

        if ($user->hasRole($this->find($roleID)->name)) {

            return -1;
        }

        $user->roles()->attach($roleID);

        return 1;
    }
}
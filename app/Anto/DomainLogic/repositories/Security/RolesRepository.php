<?php namespace app\Anto\DomainLogic\repositories\Security;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Anto\DomainLogic\repositories\User\UserRepository;
use app\Models\Role;
use Illuminate\Contracts\Auth\Guard;

class RolesRepository extends EloquentDataAccessRepository
{

    protected $auth;

    protected $user;

    /**
     * @param Role $model
     * @param Guard $guard
     * @param UserRepository $userRepository
     */
    public function __construct(Role $model, Guard $guard, UserRepository $userRepository)
    {
        parent::__construct($model);

        $this->user = $userRepository;
    }


    /**
     * Assign roles to a user
     *
     * @param $userID
     * @param array $roles
     * @return int
     */
    public function assign($userID, array $roles)
    {
        $user = $this->user->find($userID);

        $i = 0;
        foreach ($roles as $role) {
            $i++;
            if ($user->hasRole($this->find($role)->name)) {

                $roles = array_pluck($roles, $role);
            }

        }

        $user->roles()->attach($roles);

        return 1;
    }

    public function revoke($userID, array $roles)
    {

        $user = $this->user->find($userID);

        $user->roles()->detach($roles);

        return 1;
    }
}
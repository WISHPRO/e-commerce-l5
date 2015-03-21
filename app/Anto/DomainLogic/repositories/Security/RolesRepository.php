<?php namespace app\Anto\DomainLogic\repositories\Security;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Anto\DomainLogic\repositories\User\UserRepository;
use app\Models\Role;

class RolesRepository extends EloquentDataAccessRepository
{

    protected $auth;

    protected $user;

    /**
     * @param Role $model
     * @param UserRepository $userRepository
     *
     */
    public function __construct(Role $model, UserRepository $userRepository)
    {
        parent::__construct($model);

        $this->user = $userRepository;
    }


    /**
     * Assign roles to a user
     *
     * @param $userID
     * @param array $roles
     *
     * @return int
     */
    public function assign($userID, array $roles)
    {
        $user = $this->user->find($userID);

        foreach ($roles as $role) {

            if ($user->hasRole($this->find($role)->name)) {

                continue;
            }

            $user->roles()->attach($role);

        }

        return 1;
    }

    /**
     * Assign permissions to a role
     *
     * @param $roleID
     * @param array $permissions
     *
     * @return int
     */
    public function givePermissions($roleID, array $permissions)
    {

        $role = parent::find($roleID);

        $role->attachPermissions($permissions);

        return 1;
    }

    /**
     * Revoke a user's roles
     *
     * @param $userID
     * @param array $roles
     *
     * @return int
     */
    public function revoke($userID, array $roles)
    {

        $user = $this->user->find($userID);

        $user->roles()->detach($roles);

        return 1;
    }
}
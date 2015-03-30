<?php namespace App\Antony\DomainLogic\Modules\Security;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Antony\DomainLogic\modules\User\UserRepository;
use App\Models\Role;

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

            // skip roles that already belong to the user
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
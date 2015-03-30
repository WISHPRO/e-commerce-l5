<?php namespace App\Antony\DomainLogic\Modules\Security;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Antony\DomainLogic\modules\User\UserRepository;
use App\Models\Permission;

class PermissionsRepo extends EloquentDataAccessRepository
{

    protected $roles;

    protected $user;

    /**
     * @param Permission $permission
     * @param UserRepository $userRepository
     * @param RolesRepository $rolesRepository
     */
    public function __construct(Permission $permission, UserRepository $userRepository, RolesRepository $rolesRepository)
    {
        $this->model = $permission;

        $this->user = $userRepository;

        $this->roles = $rolesRepository;
    }

    /**
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        return parent::add($data);
    }

    /**
     * @param $id
     * @param array $roles
     *
     * @return int
     */
    public function assign($id, array $roles)
    {

        $permission = $this->find($id);

        //dd($permission);
        foreach ($roles as $role) {

            // find the role in the db
            $this->roles->find($role)->attachPermission($permission);
            //$role->attachPermission($permission);
        }

        return 1;

    }
}
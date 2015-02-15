<?php namespace app\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public static $rules = [
        'name' => 'required|alpha|between:3,15|unique:roles'
    ];

    public static $assignment_rules = [
        'role_id' => 'required|exists:roles,id',
        'permissions' => 'required|exists:permissions,id'
    ];

    public static $user_assignment_rules = [
        'role_id' => 'required|exists:roles,id',
        // 'email' => 'exists:staff,email,deleted_at,NULL'
        'user_id' => 'required|exists:users,id'
    ];

    protected $fillable = ['name'];
}
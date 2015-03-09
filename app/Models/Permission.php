<?php namespace app\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    public static $rules
        = [
            'name' => 'required|alpha_dash|between:3,50',
            'display_name' => 'required|between:3,50'
        ];

    protected $fillable
        = [
            'name',
            'display_name'
        ];

}
<?php namespace app\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public static $rules = [
        'name' => 'required|alpha_dash|between:3,50',
        'display_name' => 'required|between:3,50'
    ];    // hydrates on new entries' validation
    public $autoHydrateEntityFromInput = true;
    public $forceEntityHydrationFromInput = true;
    protected $fillable = ['name', 'display_name'];
}
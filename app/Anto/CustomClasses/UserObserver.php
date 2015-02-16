<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/15/2015
 * Time: 3:29 PM
 */

namespace app\Anto\CustomClasses;


use app\Models\User;

class UserObserver {

    public function saving(User $model)
    {
        //
    }

    public function saved(User $model)
    {
        //
    }

    public function deleting(User $model)
    {
        if(!$model->isDeleteMyself())
        {
            // prevent deletion of current users account
            if(\Auth::id() == $model->id)
            {
                \Flash::error('You are not allowed to delete your own account');
                return false;
            }
        }

        return true;
    }

}
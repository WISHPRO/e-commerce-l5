<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/19/2015
 * Time: 9:36 AM
 */

namespace app\Anto\Observers;


use app\Models\Cart;

class CartObserver {

    public function saving(Cart $model)
    {
        // create a cart ID, if not exist

    }

    public function saved(Cart $model)
    {
        //
    }
}
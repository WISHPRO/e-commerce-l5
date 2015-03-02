<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 3/2/2015
 * Time: 7:32 PM
 */

namespace app\Anto\Traits;


trait WishlistTrait
{

    public function getID()
    {
        return generateRandomInt();
    }


}
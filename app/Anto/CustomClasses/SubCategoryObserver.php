<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/15/2015
 * Time: 3:48 PM
 */

namespace app\Anto\CustomClasses;


use app\Models\SubCategory;

class SubCategoryObserver {

    public function saving(SubCategory $model)
    {
        // only process image if it is there
        if (!is_null($model->banner)) {
            $path = ProcessImage($model, 'banner', $model->getImgStorageDir(), true, $model->getDimensions());

            if ($path === null) {

                return false;
            }

            // assign the reference path to our banner
            $model->banner = $path;

            return true;
        }
        return true;
    }
}
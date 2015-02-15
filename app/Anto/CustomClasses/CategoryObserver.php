<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/15/2015
 * Time: 3:41 PM
 */

namespace app\Anto\CustomClasses;


use app\Models\Category;

class CategoryObserver {

    public function saving(Category $model)
    {
        // only process image if it is there
        if (!is_null($model->banner)) {

            $img_path = ProcessImage($this, 'banner', env('CATEGORY_IMAGES'), true, $model->getDimensions());

            if ($img_path === null) {
                return false;
            }

            $model->banner = $img_path;
            return true;

        }
        return true;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/15/2015
 * Time: 3:52 PM
 */

namespace app\Anto\Observers;

use app\Models\Brand;

class ProductBrandObserver
{

    public function saving(Brand $model)
    {
        // process the image, only if it is there
        if (!is_null($model->logo)) {
            $path = ProcessImage(
                $model,
                'logo',
                $model->getImgStorageDir(),
                true,
                $model->getDimensions()
            );

            if ($path === null) {
                return false;
            }

            $model->logo = $path;

            return true;
        }

        return true;
    }

    public function deleting(Brand $model)
    {
        // find the image on disk and delete it
        $current_image = $model->logo;

        return fileIsAvailable($current_image) ? deleteFile($current_image)
            : true;
    }
}
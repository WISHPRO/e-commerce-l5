<?php namespace app\Anto\Observers;

use app\Anto\Classes\ProductImage;
use app\Models\Product;
use Request;

class ProductObserver
{

    /**
     * @param Product $model
     */
    public function creating(Product $model)
    {
        $model->sku = $model->generateProductSKU();
    }

    /**
     * @param Product $model
     *
     * @return bool
     */
    public function saving(Product $model)
    {
        // if there is a new image, then do sth. otherwise leave the original one
        if ($model->isDirty('image')) {
            // get a large image first, that will be used when zooming
            $i = new ProductImage($model);

            $i->processImage();

            // resize the large image, and save it
            $model->image = reduceImage(
                $model->image_large,
                $model->getMagnifyValue(),
                $model->getImgStorageDir()
            );

            if (is_null($model->image)) {
                // error. just bail out
                return false;
            }

            return true;
        }

        return true;
    }

    /**
     * @param Product $model
     */
    public function saved(Product $model)
    {
        // grab data
        $catID = Request::get('category_id');
        $subCatID = Request::get('sub_category_id');
        $brandID = Request::get('brand_id');
        $productID = $model->id;

        // perform sync
        $model->categories()->sync([$catID], [$productID]);

        $model->brands()->sync([$brandID], [$productID]);

        // since subcategory_id is not a requirement, we may skip it if its not available
        if (!empty($subCatID)) {
            $model->subcategories()->sync([$subCatID], [$productID]);
        }

        return true;
    }

    /**
     * @param Product $model
     *
     * @return bool
     */
    public function deleting(Product $model)
    {
        // skip nulls, for mow
        if (is_null($model->image)) {
            return true;
        }
        // find the images on disk and delete em
        $current_image = $model->image;
        $larger_image = $model->image_large;

        // delete the normal image
        if (fileIsAvailable($current_image)) {

            return deleteFile($current_image);
        }
        // delete the large image
        if (fileIsAvailable($larger_image)) {

            return deleteFile($larger_image);
        }

        return true;
    }

}
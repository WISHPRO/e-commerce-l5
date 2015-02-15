<?php namespace app\Anto\CustomClasses;

use app\Models\Product;
use Laracasts\Flash\Flash;
use Request;

class ProductObserver {

    /**
     * @param Product $model
     */
    public function creating(Product $model)
    {
        $model->sku = generateProductSKU();
    }

    /**
     * @param Product $model
     * @return bool
     */
    public function saving(Product $model)
    {
        // if there is a new image, then do sth. otherwise leave the original one
        if ($model->isDirty('image')) {
            // get a large image first, that will be used when zooming
            $this->image_large = ProcessImage($this, 'image', env('PRODUCT_IMAGES'), true, $model->getDimensions());

            // resize the large image, and save it
            $this->image = reduceImage($model->image_large, env('IMG_REDUCE', 3), env('PRODUCT_IMAGES'));

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

        \Flash::success('The product has been saved');
        return true;
    }

    /**
     * @param Product $model
     * @return bool
     */
    public function deleting(Product $model)
    {
        // skip nulls, for mow
        if(is_null($model->image)){
            return true;
        }
        // find the images on disk and delete em
        $current_image = $model->image;
        $larger_image = $model->image_large;

        // delete the normal image
        if (ImageExists($current_image)) {

            return deleteFile($current_image);
        }
        // delete the large image
        if (ImageExists($larger_image)) {

            return deleteFile($larger_image);
        }
        return true;
    }

}
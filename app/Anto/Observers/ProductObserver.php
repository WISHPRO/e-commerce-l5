<?php namespace app\Anto\Observers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\Product;
use Request;

class ProductObserver
{

    protected $image;

    /**
     * @param imageProcessor $imageProcessor
     */
    public function __construct(imageProcessor $imageProcessor)
    {
        $this->image = $imageProcessor;

        $this->image->storageLocation = config('site.products.images');

        $this->image->dimensions = config('site.products.dimensions');

        $this->image->resize = true;
    }

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

            $path = $this->image->init($model, 'image')->getImage();

            if (empty($path)) {
                return false;
            }

            $model->image_large = $path;

            // create the small image
            $model->image = $this->image->reduceImage($model->image_large, config('site.products.reduce'));

            if (is_null($model->image_large | is_null($model->image))) {
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
        // delete the normal image
        if (fileIsAvailable($model->image)) {

            return deleteFile($model->image);
        }
        // delete the large image
        if (fileIsAvailable($model->image_large)) {

            return deleteFile($model->image_large);
        }

        return true;
    }

}
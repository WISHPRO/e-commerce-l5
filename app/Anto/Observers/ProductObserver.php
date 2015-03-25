<?php namespace app\Anto\Observers;

use app\Anto\DomainLogic\contracts\ImagingInterface;
use app\Models\Product;
use Request;

class ProductObserver
{
    /**
     * The image processor implementation
     *
     * @var ImagingInterface
     */
    protected $image;

    /**
     * @param ImagingInterface $imageProcessor
     */
    public function __construct(ImagingInterface $imageProcessor)
    {
        $this->image = $imageProcessor;

        $this->image->storageLocation = config('site.products.images.storage');

        $this->image->resizeDimensions = config('site.products.images.dimensions');

        $this->image->resize = false;
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
            $model->image = $this->image->reduceImage($model->image_large, config('site.products.images.reduce_ratio'));

            if (is_null($model->image_large or is_null($model->image))) {
                // error. just bail out
                return false;
            }

            return true;
        }

        return true;
    }

    /**
     * @param Product $model
     *
     * @return bool
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
        if (checkIfFileExists($model->image)) {

            return deleteFile($model->image);
        }
        // delete the large image
        if (checkIfFileExists($model->image_large)) {

            return deleteFile($model->image_large);
        }

        return true;
    }

}
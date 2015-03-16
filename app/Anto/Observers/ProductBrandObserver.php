<?php namespace app\Anto\Observers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\Brand;

class ProductBrandObserver
{
    protected $image;

    /**
     * @param imageProcessor $imageProcessor
     */
    public function __construct(imageProcessor $imageProcessor)
    {
        $this->image = $imageProcessor;

        $this->image->storageLocation = config('site.brands.images.storage');

        $this->image->resizeDimensions = config('site.brands.images.dimensions');

        $this->image->resize = true;
    }

    /**
     * @param Brand $model
     * @return bool
     */
    public function saving(Brand $model)
    {
        // process the image, only if it is there
        if (!is_null($model->logo)) {
            $path = $this->image->init($model, 'logo')->getImage();

            if (empty($path)) {
                return false;
            }

            $model->logo = $path;

            return true;
        }

        return true;
    }

    /**
     * @param Brand $model
     * @return bool
     */
    public function deleting(Brand $model)
    {
        // find the image on disk and delete it
        $current_image = $model->logo;

        return fileIsAvailable($current_image) ? deleteFile($current_image) : true;
    }
}
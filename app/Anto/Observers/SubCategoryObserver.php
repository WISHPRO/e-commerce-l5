<?php namespace app\Anto\Observers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\SubCategory;

class SubCategoryObserver
{

    protected $image;

    /**
     * @param imageProcessor $imageProcessor
     */
    public function __construct(imageProcessor $imageProcessor)
    {
        $this->image = $imageProcessor;

        $this->image->storageLocation = config('site.subcategories.images.storage');

        $this->image->resizeDimensions = config('site.subcategories.images.dimensions');

        $this->image->resize = true;
    }

    public function saving(SubCategory $model)
    {
        // process the image, only if it is there
        if (!is_null($model->banner)) {
            $path = $this->image->init($model, 'banner')->getImage();

            if (empty($path)) {
                return false;
            }

            $model->banner = $path;

            return true;
        }

        return true;
    }


    /**
     * @param SubCategory $model
     *
     * @return bool
     */
    public function deleting(SubCategory $model)
    {
        // find the image on disk and delete it
        $current_image = $model->banner;

        return fileIsAvailable($current_image) ? deleteFile($current_image) : true;
    }
}
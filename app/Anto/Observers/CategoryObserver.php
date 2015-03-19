<?php namespace app\Anto\Observers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\Category;

class CategoryObserver
{

    protected $image;

    /**
     * @param imageProcessor $imageProcessor
     */
    public function __construct(imageProcessor $imageProcessor)
    {
        $this->image = $imageProcessor;

        $this->image->storageLocation = config('site.categories.images.storage');

        $this->image->resizeDimensions = config('site.categories.images.dimensions');

        $this->image->resize = true;
    }

    public function saving(Category $model)
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
     * @param Category $model
     *
     * @return bool
     */
    public function deleting(Category $model)
    {
        // find the image on disk and delete it
        $current_image = $model->banner;

        return fileIsAvailable($current_image) ? deleteFile($current_image) : true;
    }
}
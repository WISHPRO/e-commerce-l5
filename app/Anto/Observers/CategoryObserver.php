<?php namespace app\Anto\Observers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\Category;

class CategoryObserver
{

    /**
     * @param imageProcessor $imageProcessor
     */
    public function __construct(imageProcessor $imageProcessor)
    {
        $this->image = $imageProcessor;

        $this->image->storageLocation = config('site.categories.images');
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
}
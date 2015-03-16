<?php namespace app\Anto\Observers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\Ads;

class adsObserver
{

    protected $image;

    /**
     * @param imageProcessor $imageProcessor
     */
    public function __construct(imageProcessor $imageProcessor)
    {
        $this->image = $imageProcessor;

        $this->image->storageLocation = config('site.ads.storage');

        $this->image->resizeDimensions = config('site.ads.dimensions');

        $this->image->resize = true;
    }

    public function saving(Ads $model)
    {
        if ($model->isDirty('image')) {

            $path = $this->image->init($model, 'image')->getImage();

            if (empty($path)) {
                return false;
            }

            $model->image = $path;

            return true;
        }

        return true;

    }

    public function deleting(Ads $model)
    {
        // find the image on disk and delete it
        $current_image = $model->image;

        return fileIsAvailable($current_image) ? deleteFile($current_image) : true;
    }
}
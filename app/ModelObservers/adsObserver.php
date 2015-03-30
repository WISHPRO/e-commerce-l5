<?php namespace App\ModelObservers;

use App\Antony\DomainLogic\Contracts\Imaging\ImagingInterface;
use App\Models\Ad;

class adsObserver
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

        $this->image->storageLocation = config('site.ads.storage');

    }


    /**
     * @param Ad $model
     *
     * @return bool
     */
    public function saving(Ad $model)
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

    /**
     * @param Ad $model
     *
     * @return bool
     */
    public function deleting(Ad $model)
    {
        // find the image on disk and delete it
        $current_image = $model->image;

        return checkIfFileExists($current_image) ? deleteFile($current_image) : true;
    }
}

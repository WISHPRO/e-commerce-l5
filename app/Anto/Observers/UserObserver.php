<?php namespace app\Anto\Observers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\User;

class UserObserver
{
    protected $image;

    /**
     * @param imageProcessor $imageProcessor
     */
    public function __construct(imageProcessor $imageProcessor)
    {

        $this->image = $imageProcessor;

        $this->image->storageLocation = config('site.users.images.storage');

    }

    /**
     * @param User $model
     *
     * @return bool
     */
    public function saving(User $model)
    {
        // process the image, only if it is there
        if (!is_null($model->photo)) {
            $path = $this->image->init($model, 'photo')->getImage();

            if (empty($path)) {
                return false;
            }

            $model->photo = $path;

            return true;
        }

        return true;
    }

    /**
     * @param User $model
     *
     * @return bool
     */
    public function deleting(User $model)
    {
        // find the image on disk and delete it
        $current_image = $model->photo;

        return fileIsAvailable($current_image) ? deleteFile($current_image) : true;
    }

}
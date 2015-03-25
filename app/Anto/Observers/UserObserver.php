<?php namespace app\Anto\Observers;

use app\Anto\DomainLogic\contracts\ImagingInterface;
use app\Models\User;

class UserObserver
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

        return checkIfFileExists($current_image) ? deleteFile($current_image) : true;
    }

}
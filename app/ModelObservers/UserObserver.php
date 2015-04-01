<?php namespace App\ModelObservers;

use App\Antony\DomainLogic\Contracts\Imaging\ImagingInterface;
use App\Events\UserWasRegistered;
use App\Models\User;

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
    public function created(User $model)
    {
        // send registration email
        $response = event(new UserWasRegistered($model));

        return true;
    }

    /**
     * @param User $model
     *
     * @return bool
     */
    public function saving(User $model)
    {
        // process the image, only if it is there / modified
        if ($model->isDirty('avatar')) {
            $path = $this->image->init($model, 'avatar')->getImage();

            if (empty($path)) {
                return false;
            }

            $model->avatar = $path;

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
        $current_image = $model->avatar;

        return checkIfFileExists($current_image) ? deleteFile($current_image) : true;
    }

}
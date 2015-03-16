<?php namespace app\Anto\Logic\repositories;

use Illuminate\Database\Eloquent\Model;

class imageProcessor
{
    public $originalPath;

    public $originalName;

    public $model;

    public $property;

    public $storageLocation;

    public $uniqueName;

    public $resize = false;

    public $data;

    public $resizeDimensions = [];

    /**
     * Initialize key variables, and attempt to link up all the processing functions
     *
     * @param Model $model
     * @param $attribute
     * @return $this
     */
    public function init(Model $model, $attribute)
    {
        $this->model = $model;

        $this->property = $attribute;

        $this->data = $this->getOriginalImagePath($this->property)->getOriginalImageName($this->property)->getUniqueImageName()->createImage();

        return $this;
    }

    /**
     * Creates the image, and saves it to the filesystem
     *
     * @return mixed
     */
    public function createImage()
    {
        if ($this->resize) {

            $height = array_get($this->resizeDimensions, 'height');

            $width = array_get($this->resizeDimensions, 'width');

            return \Image::make($this->originalPath)->resize($width, $height)->save(base_path() . $this->storageLocation . '/' . $this->uniqueName);

        } else {

            return \Image::make($this->originalPath)->save(base_path() . $this->storageLocation . '/' . $this->uniqueName);
        }
    }

    /**
     * Gets the unique name of an image
     *
     * @return $this
     */
    public function getUniqueImageName($extra = [])
    {
        $name = '';
        // add extra attributes to the name
        if (!empty($extra)) {
            foreach ($extra as $key => $value) {
                $name = $name . $value;
            }

            $this->uniqueName = time() . '-' . $name . '-' . str_replace(' ', '_', $this->originalName);

            return $this;
        }

        $this->uniqueName = time() . '-' . str_replace(' ', '_', $this->originalName);

        return $this;
    }

    /**
     * Gets the original name of the image
     *
     * @param $property
     * @return $this
     */
    public function getOriginalImageName($property)
    {
        $this->originalName = $this->model->$property->getClientOriginalName();

        return $this;
    }

    /**
     * Gets the original path of the image uploaded
     *
     * @param $property
     * @return $this
     */
    public function getOriginalImagePath($property)
    {
        $this->originalPath = $this->model->$property->getRealPath();

        return $this;
    }

    /**
     * Gets the processed image
     *
     * @return null|string
     */
    public function getImage()
    {
        if (empty($this->data)) {
            // failure in processing the image. nothing much we can do
            return null;
        } else {
            $path = $this->data->basePath();

            // get path to image
            return $this->processImagePath($path);
        }
    }

    /**
     * processes the images base bath, to reflect our images storage root directory
     *
     * @param $path
     * @return string
     */
    public function processImagePath($path)
    {
        $pos = strpos($path, '/assets/');
        if ($pos !== false) {

            return substr($path, $pos);
        }

        return $path;
    }

    /**
     * @param $image
     * @param $times
     * @return null|string
     */
    public function reduceImage($image, $times)
    {
        // first we check if the image exists, so that we work on it
        if (fileIsAvailable($image)) {
            // create image from data provided. in this case, the data provided is the path to the image
            $old_image = \Image::make(public_path() . $image);
            // get dimensions
            $width = $old_image->getWidth();

            $height = $old_image->getHeight();

            // resize the image
            $old_image->resize($width / $times, $height / $times);
            // path variable
            $path = base_path() . $this->storageLocation . '/' . $this->uniqueName . '-small' . '.' . $old_image->extension;

            // save new image in filesystem
            $new_image = $old_image->save($path);
            if (empty($new_image)) {
                // failure in processing the image. nothing much we can do
                return null;
            }
            // return the path to the reduced image
            return $this->processImagePath($new_image->basePath());

        } else {

            return null;
        }

    }
}
<?php namespace app\Anto\Logic\repositories;

use Illuminate\Database\Eloquent\Model;
use Image;

class imageProcessor
{

    /**
     * The root path of the image storage directory
     *
     * @var string
     */
    public $rootPath = '/assets/';

    /**
     * The original path of the image
     *
     * @var string
     */
    public $originalPath;

    /**
     * The original name of the image
     *
     * @var string
     */
    public $originalName;

    /**
     * Eloquent Model that the image property is related to
     *
     * @var Model
     */
    public $model;

    /**
     * The image property of the model
     *
     * @var string
     */
    public $property;

    /**
     * The quality of the image to be saved
     *
     * @var int
     */
    public $imgQuality = 80;

    /**
     * The storage location of the generated image
     *
     * @var string
     */
    public $storageLocation;

    /**
     * A unique generated name, for the image
     *
     * @var string
     */
    public $uniqueName;

    /**
     * Specifies if the image should be resized
     *
     * @var boolean
     */
    public $resize = false;

    /**
     * Intermediate result after processing an image
     *
     * @var mixed
     */
    public $data;

    /**
     * Dimensions which will be used to resize an image
     *
     * @var array
     */
    public $resizeDimensions = [];

    /**
     * Initialize key variables, and attempt to link up all the processing functions
     *
     * @param Model $model
     * @param $attribute
     *
     * @return $this
     */
    public function init(Model $model, $attribute)
    {
        $this->model = $model;

        $this->property = $attribute;

        $this->data = $this->getOriginalImagePath($this->property)
            ->getOriginalImageName($this->property)
            ->getUniqueImageName()->createImage();

        return $this;
    }

    /**
     * Creates the image, and saves it to the filesystem
     * In this case, we are using the intervention image library
     *
     * @return mixed
     */
    public function createImage()
    {
        if ($this->resize) {

            // get the resize dimensions
            $height = array_get($this->resizeDimensions, 'height');

            $width = array_get($this->resizeDimensions, 'width');

            return Image::make($this->originalPath)->resize($width, $height)
                ->save(base_path() . $this->storageLocation . '/' . $this->uniqueName, $this->imgQuality);

        } else {

            return Image::make($this->originalPath)
                ->save(base_path() . $this->storageLocation . '/' . $this->uniqueName, $this->imgQuality);
        }
    }

    /**
     * Gets the unique name of an image
     *
     * @return $this
     */
    public function getUniqueImageName()
    {

        $name = time() . '-' . str_slug($this->originalName);

        $name = str_replace($this->getExtension($this->property), '', $name);

        $this->uniqueName = $name . '.' . $this->getExtension($this->property);

        return $this;
    }

    /**
     * @param $property
     *
     * @return mixed
     */
    public function getExtension($property)
    {
        return $this->model->$property->getClientOriginalExtension();
    }

    /**
     * Gets the original name of the image
     *
     * @param $property
     *
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
     *
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
     *
     * @return string
     */
    public function processImagePath($path)
    {
        $pos = strpos($path, $this->rootPath);
        if ($pos !== false) {

            return substr($path, $pos);
        }

        return $path;
    }

    /**
     * @param $image
     * @param $times
     *
     * @return null|string
     */
    public function reduceImage($image, $times)
    {
        // first we check if the image exists, so that we work on it
        if (checkIfFileExists($image)) {
            // create image from data provided. in this case, the data provided is the path to the image
            $old_image = Image::make(public_path() . $image);
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
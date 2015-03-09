<?php namespace app\Anto\Logic\repositories;

use app\Anto\Logic\interfaces\ImageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class Image implements ImageRepositoryInterface
{

    protected $model;

    protected $img_attribute;

    protected $name;

    protected $uniqueName;

    protected $intermediate_path;

    protected $newPath;

    protected $originalPath;

    protected $dimensions = [];

    protected $originalName;

    protected $resize = true;

    protected $storageLocation;

    /**
     * @param Model $model
     * @param       $attribute
     * @param       $storage
     */
    public function __construct(Model $model, $attribute, $storage)
    {
        $this->model = $model;

        $this->getImageAttribute($attribute);

        $this->storageLocation = $storage;
    }

    public function getImageAttribute($attribute)
    {
        $this->img_attribute = $this->model->$attribute;
    }

    /**
     * @return string
     */
    public function processImage()
    {
        $this->newPath = $this->init()->create()->processPath();

        return $this->newPath;
    }

    public function processPath()
    {
        $pos = strpos($this->intermediate_path, '/assets/');
        if ($pos !== false) {
            // 2cnd;
            // replace the original path with /assets/$path
            $img_path = substr($this->intermediate_path, $pos);

            return $img_path;
        }
        // this might result in an error, later. but am sure the condition above will satisfy. because,
        // its obvious that the initial path will have to include 'assets' somewhere. unless the folder names got changed
        return $this->intermediate_path;
    }

    public function create()
    {
        list($height, $width) = $this->dimensions;

        if ($this->resize) {

            $this->intermediate_path = \Image::make($this->originalPath)
                ->resize($width, $height)->save(
                    base_path() . $this->storageLocation . '/'
                    . $this->uniqueName
                );

            return $this;
        } else {

            $this->intermediate_path = \Image::make($this->originalPath)->save(
                base_path() . $this->storageLocation . '/' . $this->uniqueName
            );

            return $this;
        }

    }

    private function init()
    {
        $this->extractDimensions()->getOriginalPath()->getOriginalName();

        $this->assignUniqueName();

        return $this;
    }

    public function getOriginalName()
    {
        $this->originalName
            = $this->model->img_attribute->getClientOriginalName();
    }

    public function getOriginalPath()
    {
        $this->originalPath = $this->model->img_attribute->getRealPath();

        return $this;
    }

    public function extractDimensions()
    {
        $this->dimensions = $this->model->getDimensions();

        return $this;
    }

    public function assignUniqueName()
    {
        $this->uniqueName = hash('sha256', $this->originalName . time()) . beautify($this->originalName);

        return $this;
    }

    public function diminish()
    {
        // TODO: Implement diminish() method.
    }

}
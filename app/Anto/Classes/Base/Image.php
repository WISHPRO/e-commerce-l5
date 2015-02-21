<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/20/2015
 * Time: 7:03 PM
 */

namespace app\Anto\Classes\Base;


use app\Anto\Repositories\ImageRepository;
use app\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Image implements ImageRepository
{

    protected $model;

    protected $img_attribute;

    protected $name;

    protected $uniqueName;

    protected $intermediate_path;

    protected $newPath;

    protected $originalPath;

    protected $dimensions = [ ];

    protected $originalName;

    protected $resize = true;

    protected $storageLocation;

    public function __construct( Model $model, $attribute, $storage )
    {
        $this->model = $model;

        $this->getImageAttribute( $attribute );

        $this->storageLocation = $storage;
    }

    public function getImageAttribute( $attribute )
    {
        $this->img_attribute = $this->model->$attribute;
    }

    function processImage()
    {
        $this->newPath = $this->init()->create()->processPath();

        return $this->newPath;
    }

    public function processPath()
    {
        $pos = strpos( $this->intermediate_path, '/assets/' );
        if ($pos !== false) {
            // 2cnd;
            // replace the original path with /assets/$path
            $img_path = substr( $this->intermediate_path, $pos );

            return $img_path;
        }
        // this might result in an error, later. but am sure the condition above will satisfy. because,
        // its obvious that the initial path will have to include 'assets' somewhere. unless the folder names got changed
        return $this->intermediate_path;
    }

    public function create()
    {
        list( $height, $width ) = $this->dimensions;

        if ($this->resize) {

            $this->intermediate_path = \Image::make( $this->originalPath )->resize( $width, $height )->save(
                base_path() . $this->storageLocation . '/' . $this->uniqueName
            );

            return $this;
        } else {

            $this->intermediate_path = \Image::make( $this->originalPath )->save(
                base_path() . $this->storageLocation . '/' . $this->uniqueName
            );

            return $this;
        }

    }

    protected function init()
    {
        $this->extractDimensions()->getOriginalPath()->getOriginalName();

        $this->assignUniqueName();

        return $this;
    }

    public function getOriginalName()
    {
        $this->originalName = $this->model->img_attribute->getClientOriginalName();
    }

    public function getOriginalPath()
    {
        $this->originalPath = $this->model->image->getRealPath();

        return $this;
    }

    public function extractDimensions()
    {
        $this->dimensions = $this->model->getDimensions();

        return $this;
    }

    public function assignUniqueName()
    {
        $this->uniqueName = hash( 'sha256', $this->originalName . time() ) . strtolower(
                str_replace( ' ', '_', $this->originalName )
            );

        return $this;
    }

    function diminish()
    {
        // TODO: Implement diminish() method.
    }

}
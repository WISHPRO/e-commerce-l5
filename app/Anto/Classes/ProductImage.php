<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/20/2015
 * Time: 7:42 PM
 */

namespace app\Anto\Classes;


use app\Anto\Classes\Base\Image;
use app\Models\Product;

class ProductImage extends Image
{

    public $resize = true;

    public $storageLocation;

    public function __construct( Product $product )
    {
        parent::__construct( $product, $product->image, $product->getImgStorageDir() );
    }

    public function getImage()
    {

        return parent::processImage();
    }

    public function diminish()
    {

    }

}
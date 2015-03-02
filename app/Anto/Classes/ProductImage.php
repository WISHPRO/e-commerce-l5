<?php namespace app\Anto\Classes;

use app\Anto\Classes\Base\Image;
use app\Models\Product;

class ProductImage extends Image
{

    public function __construct(Product $product)
    {
        parent::__construct(
            $product,
            $product->image_large,
            $product->getImgStorageDir()
        );
    }
}
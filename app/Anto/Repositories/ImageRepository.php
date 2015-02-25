<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/20/2015
 * Time: 6:58 PM
 */

namespace app\Anto\Repositories;


interface ImageRepository
{

    function assignUniqueName();

    function getImageAttribute( $attribute );

    function getOriginalName();

    function processPath();

    function getOriginalPath();

    function extractDimensions();

    function create();

    function processImage();

    function diminish();
}
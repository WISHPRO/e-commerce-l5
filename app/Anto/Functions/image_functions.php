<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/11/2015
 * Time: 11:44 AM
 */
use Illuminate\Database\Eloquent\Model;


/** A wrapper function for the intervention image library, to customize my images
 * source object .... eg an instance of a model
 * input source ..... eg an image input field name
 * @param Model $model
 * @param $image_object_name
 * @param $storage_location
 * @param bool $resize
 * @param array $resizeRules
 * @return null|string
 */
function ProcessImage( Model $model, $image_object_name, $storage_location, $resize = true, $resizeRules = [] )
{
    /* Image processing */

    // step 1: get the path of the uploaded image
    $img_path = getOriginalImagePath($model, $image_object_name);

    // get the original name of the uploaded image
    $original_image_name = getOriginalImageName($model, $image_object_name);

    // step 2: give a new name to the image to be created
    // you can use the original name, or just make the name unique. like for me;
    // i chose a SHA256 hash of the images' original name + a timestamp
    $new_image_name = getUniqueImageName($original_image_name);

    // optional step: provide height and width, which will be used when resizing the image
    // if the user didn't provide any, we just read the defaults from our config
    list($height, $width) = extractDimensions($resizeRules);

    // step 3: Save the image to disk
    $image_object_name = createImage($storage_location, $img_path, $new_image_name, $resize, $width, $height);
    if (empty($image_object_name)) {
        // failure in processing the image. nothing much we can do
        return null;
    }

    // get the directory path where the image was stored. According to our config, this would look like
    // E:\project\e-commerce/public/assets/images/brands/blablabla
    $path = $image_object_name->basePath();

    // get path to image
    $img_path = processImagePath($path);

    // step 4: return the new image path. This will be saved as a BLOB in the database
    return $img_path;
}

/**
 * @param Model $model
 * @param $image_object_name
 * @return mixed
 */
function getOriginalImageName(Model $model, $image_object_name)
{
    return $model->$image_object_name->getClientOriginalName();
}

/**
 * @param Model $model
 * @param $image_object_name
 * @return mixed
 */
function getOriginalImagePath(Model $model, $image_object_name)
{
    return $model->$image_object_name->getRealPath();
}

/**
 * @param $resizeRules
 * @return array
 */
function extractDimensions($resizeRules)
{
    $height = array_get($resizeRules, 'height', 200);
    $width = array_get($resizeRules, 'width', 300);
    return array($height, $width);
}

/**
 * Creates the image, resizes it if necessary, and saves it to a location, applying the unique name generated
 * @param $storage_location
 * @param $img_path
 * @param $new_image_name
 * @param bool $resize
 * @param $width
 * @param $height
 * @return \Intervention\Image\Image
 */
function createImage($storage_location, $img_path, $new_image_name, $resize = true, $width = null, $height = null)
{
    if($resize)
    {
        return Image::make($img_path)->resize($width, $height)->save(base_path() . $storage_location . '/' . $new_image_name);
    }
    else {
        return Image::make($img_path)->save(base_path() . $storage_location . '/' . $new_image_name);
    }
}

/**
 * Creates a unique name for the image to be saved
 * @param $original_image_name
 * @return string
 */
function getUniqueImageName($original_image_name)
{
    return hash('sha256', $original_image_name . time()) . strtolower(str_replace(' ', '_', $original_image_name));
}

/**
 * Creates a new image path that matches our storage configuration, ie
 * Remove the 'E:\project\e-commerce/public /assets' portion
 * thanks to http://stackoverflow.com/questions/25993123/laravel-4-2-storing-image-path-to-database
 * @param $path
 * @return string
 */
function processImagePath($path)
{
    // 1st;
    // get the index position of '/assets/', which defines the default location of all our sites assets
    $pos = strpos($path, '/assets/');
    if ($pos !== false) {
        // 2cnd;
        // replace the original path with /assets/$path
        $img_path = substr($path, $pos);
        return $img_path;
    }
    // this might result in an error, later. but am sure the condition above will satisfy. because,
    // its obvious that the initial path will have to include 'assets' somewhere. unless the folder names got changed
    return $path;
}


/**
 * Allows us to reduce an image by factor X
 * @param $image
 * @param int $times
 * @param $savePath
 * @return null|string
 */
function reduceImage($image, $times, $savePath)
{
    // first we check if the image exists, so that we work on it
    if(fileIsAvailable($image)){
        // create image from data provided. in this case, the data provided is the path to the image
        $old_image = Image::make( public_path() . $image);
        // get dimensions
        $width = $old_image->getWidth();
        $height = $old_image->getHeight();
        // get the new dimensions, after reducing by factor provided
        $width = ($width / $times);
        $height = ($height / $times);

        // resize the image
        $old_image->resize($width, $height);
        // path variable
        $path = base_path() . $savePath. '/' . hash('sha256' , $image) . '.' . $old_image->extension;
        // save new image in filesystem
        $new_image = $old_image->save($path);
        if (empty($new_image)) {
            // failure in processing the image. nothing much we can do
            return null;
        }
        // return the path to the reduced image
        return processImagePath($new_image->basePath());

    } else {

        return null;
    }

}
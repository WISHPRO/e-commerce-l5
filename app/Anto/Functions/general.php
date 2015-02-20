<?php

// GENERAL SITE FUNCTIONS
use app\Models\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * Helper to generate csrf
 * @return string
 */
function generateCSRF()
{
    $csrf = csrf_token();
    return "<input type=\"hidden\" name=\"_token\" value=$csrf >";
}


/**
 * @return string
 */
function getErrorImage()
{
    return asset(config('site.static.error'));
}


/**
 * @return string
 */
function getAjaxImage()
{
    return asset(config('site.static.ajax'));
}

/**
 * @return string
 */
function getDefaultUserAvatar()
{
    return asset(config('site.static.avatar'));
}

/**
 * @return mixed
 */
function getMaxStars()
{
    return config('site.reviews.stars');
}

/**
 * @return mixed
 */
function composerCachingEnabled()
{
    return config('site.composers.cache');
}

/**
 * @return mixed
 */
function composerCachingDuration()
{
    return config('site.composers.duration');
}

/**
 * generate secure random numbers
 * @param $bytes
 * @param $mins
 * @param $max
 * @return int|number
 */
function generateRandomInt($min = 1000, $max = 99999999, $bytes = 4)
{
    if(function_exists('openssl_random_pseudo_bytes'))
    {
        $strong = true;
        $n = 0;

        do{
            $n = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes, $strong)));
        }
        while($n < $min || $n > $max);

        return $n;
    }
    else{
        return mt_rand($min, $max);
    }
}

/**
 * Allows us to remove un-needed characters from a name
 * @param $name
 * @param bool $capitalize_first_letters
 * @return string
 */
function beautify($name, $capitalize_first_letters = true, $simple = true)
{
    if($capitalize_first_letters){
        $string = ucwords( preg_replace("/[^A-Za-z0-9 ]/", '-', $name) );
    }
    else if($simple){
        $string = ucfirst( str_replace('_', ' ', $name) );
    }
    else {
        $string = strtolower( preg_replace("/[^A-Za-z0-9 ]/", '-', $name) );
    }

    return $string;

}

/**
 * Determine if a string exceeds set limit
 * @param $string
 * @param int $limit
 * @return bool
 */
function exceedsLimit($string, $limit = 100)
{
    return strlen($string) > $limit;
}

/**
 * Allows us to check if an image/file exists
 * @param $file
 * @return bool
 */
function fileIsAvailable($file)
{
    if(empty($file))
    {
        return false;
    }

    return file_exists( public_path() . $file );
}

/**
 * Allows us to delete a file from the public path
 * @param $file
 * @return bool
 */
function deleteFile($file)
{
    if(empty($image))
    {
        return false;
    }

    return File::delete( public_path() . $file );
}

/**
 * custom url generator function, for the login part. i'll use when i need to
 * I actually wanted sth like /auth/login?returnURL=someUrl, so just copied this from stackoverflow
 * @param null $path
 * @param array $queryString
 * @param bool $secure
 * @return string
 */
function getCustomURL($path = null, $queryString = array(), $secure = true)
{
    $url = app( 'url' )->to( $path , $secure );
    if (count($queryString)) {

        foreach ($queryString as $key => $value) {
            $queryString[$key] = sprintf('%s=%s', $key, urlencode($value));
        }

        $url = sprintf('%s?%s', $url, implode('&', $queryString));
    }
    return $url;
}

/**
 * Allows us to display a picture/image of a model. if it has one already
 * @param Model $model
 * @param string $image
 * @param bool $fallback
 * @return null|string
 */
function displayImage(Model $model, $image = 'image', $fallback = true)
{
    if(fileIsAvailable($model->$image)){

        return asset($model->image);

    } else {

        if($fallback){

            return asset(getErrorImage());
        }
       else{

           return null;
       }
    }
}

/**
 * Allows us to display a larger image of a product. for zooming purposes
 * @param Product $product
 * @return null|string
 */
function displayLargeImage(Product $product)
{
    // asset($product->image_large)
    return displayImage($product, 'image_large');
}

/**
 * Display user status on the homepage.
 * If a user isn't logged in, the default string will be displayed
 * @param string $default
 * @return string
 */
function displayUserStatus($default = "My Account")
{
    return Auth::check() ? beautify(Auth::user()->getUserName()) : $default;
}
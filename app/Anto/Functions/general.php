<?php

// GENERAL SITE FUNCTIONS, which could not be put in traits or interfaces for one reason or another
use app\Models\Product;
use Illuminate\Database\Eloquent\Model;

require_once __DIR__.'/pull_config.php';

/**
 * Helper to generate csrf
 *
 * @return string
 */
function generateCSRF()
{
    $csrf = csrf_token();

    return "<input type=\"hidden\" name=\"_token\" value=$csrf >";
}

/**
 * generate secure random numbers
 *
 * @param $bytes
 * @param $mins
 * @param $max
 *
 * @return int|number
 */
function generateRandomInt($min = 1000, $max = 99999999, $bytes = 4)
{
    if (function_exists('openssl_random_pseudo_bytes')) {
        $strong = true;
        $n = 0;

        do {
            $n = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes, $strong)));
        } while ($n < $min || $n > $max);

        return $n;
    } else {
        return mt_rand($min, $max);
    }
}

/**
 * Allows us to remove un-needed characters from a name
 *
 * @param      $name
 * @param bool $capitalize_first_letters
 *
 * @return string
 */
function beautify($name)
{
    return ucwords(preg_replace("/[^A-Za-z0-9 ]/", '-', $name));
}

/**
 * Determine if a string exceeds set limit
 *
 * @param     $string
 * @param int $limit
 *
 * @return bool
 */
function exceedsLimit($string, $limit = 100)
{
    return strlen($string) > $limit;
}

/**
 * Allows us to check if an image/file exists
 *
 * @param $file
 *
 * @return bool
 */
function fileIsAvailable($file)
{
    if (empty($file)) {
        return false;
    }

    return file_exists(public_path().$file);
}

/**
 * Allows us to delete a file from the public path
 *
 * @param $file
 *
 * @return bool
 */
function deleteFile($file)
{
    if (empty($image)) {
        return false;
    }

    return File::delete(public_path().$file);
}

/**
 * Allows us to display a picture/image of a model. if it has one already
 *
 * @param Model  $model
 * @param string $image
 * @param bool   $fallback
 *
 * @return null|string
 */
function displayImage(Model $model, $image = 'image', $fallback = true)
{
    if (fileIsAvailable($model->$image)) {

        return asset($model->image);

    } else {

        if ($fallback) {

            return asset(getErrorImage());
        } else {

            return null;
        }
    }
}

/**
 * Allows us to check if a cart exists. just a wrapper around the getShoppingCart function
 *
 * @return bool
 */
function cartExists($returnInstance = false, $dbCheck = true)
{
    $cartID = cartCookieValue();

    if ($returnInstance) {
        if ($cartID == null) {
            return false;

        } else {

            return \app\Models\Cart::find($cartID);
        }
    } else {

        if (!$dbCheck) {
            return Cookie::get('shopping_cart') != null;
        }

        return \app\Models\Cart::find($cartID) != null;
    }

}

function cartCookieValue($wholeObject = false)
{
    $data = Cookie::get('shopping_cart');
    if ($wholeObject) {
        return $data;
    }
    if (is_object($data)) {
        return $data->id;

    } elseif (is_array($data)) {
        return array_pull($data, 'id');

    } else {
        return $data;
    }
}
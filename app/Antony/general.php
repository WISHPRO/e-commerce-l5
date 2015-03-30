<?php

// GENERAL SITE FUNCTIONS, which could not be put in traits, classes or interfaces for one reason or another
use Illuminate\Database\Eloquent\Model;

/**
 * @return mixed
 */
function getAllowedIPs()
{
    return config('site.backend.allowedIPS');
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
function int_random($min = 1000, $max = 99999999, $bytes = 4)
{
    if (function_exists('openssl_random_pseudo_bytes')) {
        $strong = true;
        $n = 0;

        do {
            $n = hexdec(
                bin2hex(openssl_random_pseudo_bytes($bytes, $strong))
            );
        } while ($n < $min || $n > $max);

        return $n;
    } else {
        return mt_rand($min, $max);
    }
}

/**
 * beautify a name, by capitalizing its first letters and removing spaces
 *
 * @param $name
 *
 * @return string
 */
function beautify($name)
{
    return ucwords(preg_replace("/[^A-Za-z0-9 ]/", '-', $name));
}

/**
 * Allows us to generate an SEO compatible name/url
 *
 * @param $string
 *
 * @return mixed|string
 */
function preetify($string)
{
    return str_slug($string, '-');
}

/**
 * Allows us to check if an image/file exists
 *
 * @param $file
 *
 * @return bool
 */
function checkIfFileExists($file)
{
    if (empty($file)) {
        return false;
    }

    return file_exists(public_path() . $file);
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
    if (empty($file)) {
        return false;
    }

    return File::delete(public_path() . $file);
}

/**
 * Allows us to display a picture/image of a model. if it has one already
 *
 * @param Model $model
 * @param string $image
 * @param bool $fallback
 *
 * @return null|string
 */
function displayImage(Model $model, $image = 'image', $fallback = true)
{
    if (checkIfFileExists($model->$image)) {

        return asset($model->$image);

    } else {

        if ($fallback) {

            return asset(getErrorImage());
        } else {

            return null;
        }
    }
}
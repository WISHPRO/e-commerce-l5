<?php

// GENERAL SITE FUNCTIONS, which need be used within the global scope
use App\Antony\DomainLogic\Modules\ShoppingCart\Formatters\MoneyFormatter;
use Illuminate\Database\Eloquent\Model;
use Money\Currency;
use Money\Money;

/**
 * @return mixed
 */
function getAllowedIPs()
{
    return config('site.backend.allowedIPS');
}

/**
 * @return mixed
 */
function api_login_enabled()
{
    return config('site.account.api_login');
}

/**
 * @return mixed
 */
function api_registration_enabled()
{
    return config('site.account.api_registration');
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
function getAlternateAJAXImage()
{
    return asset(config('site.static.ajax2'));
}

/**
 * @return string
 */
function getLargeAJAXImage()
{
    return asset(config('site.static.ajax3'));
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
 * Helper to generate csrf + html string
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
 * @param int $min
 * @param int $max
 *
 * @param int $bytes
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

// http://stackoverflow.com/questions/1369936/check-to-see-if-a-string-is-serialized
/**
 * @param $data
 *
 * @return bool
 */
function is_serialized($data)
{
    // if it isn't a string, it isn't serialized
    if (!is_string($data))
        return false;
    $data = trim($data);
    if ('N;' == $data)
        return true;
    if (!preg_match('/^([adObis]):/', $data, $badions))
        return false;
    switch ($badions[1]) {
        case 'a' :
        case 'O' :
        case 's' :
            if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data))
                return true;
            break;
        case 'b' :
        case 'i' :
        case 'd' :
            if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data))
                return true;
            break;
    }
    return false;
}

/**
 * hash a value by default, using SHA1
 *
 * @param $data
 *
 * @return string
 */
function h($data)
{
    return hash('sha1', $data);
}

/**
 * Formats a money object to price + value. eg Money A becomes KSH 10000
 *
 * @param $money
 *
 * @param bool $returnMoneyObject
 *
 * @return mixed
 */
function formatMoneyValue($money, $returnMoneyObject = false)
{
    if (!$money instanceof Money) {

        $money = new Money($money, new Currency(config('site.currencies.default', 'KES')));
    }
    if ($returnMoneyObject) {
        return $money;
    }
    $formatter = new MoneyFormatter();

    return $formatter->format($money);
}
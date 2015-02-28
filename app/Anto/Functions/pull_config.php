<?php

/**
 * @return mixed
 */
function getAllowedIPs()
{
    return config('allowedIPS');
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
    return config('site.composers.cache', false);
}

/**
 * @return mixed
 */
function composerCachingDuration()
{
    return config('site.composers.duration');
}

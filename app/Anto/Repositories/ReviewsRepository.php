<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/22/2015
 * Time: 12:10 AM
 */

namespace app\Anto\Repositories;


interface ReviewsRepository
{

    function calculateAverage();

    function hasReviews();

    function determineCount();
}
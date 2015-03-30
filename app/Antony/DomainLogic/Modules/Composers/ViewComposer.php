<?php namespace App\Antony\DomainLogic\Modules\Composers;

use App\Antony\DomainLogic\contracts\caching\CacheInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

abstract class ViewComposer
{

    /**
     * output variable name
     *
     * @var string
     */
    protected $outputVariable;

    /**
     * Cache implementation
     *
     * @var CacheInterface
     */
    protected $cache;

    /**
     * Model from which the data will be queried
     *
     * @var Model
     */
    protected $model;


    /**
     * Compose the View
     *
     * @param View $view
     *
     * @return mixed
     */
    abstract function compose(View $view);

}
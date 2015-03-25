<?php namespace app\Anto\domainLogic\repositories\composers;

use app\Anto\DomainLogic\contracts\CacheInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

abstract class ViewComposer
{

    /**
     * output variable name
     *
     * @var string
     */
    protected $outputVariable = null;

    /**
     * Cache implementation
     *
     * @var CacheInterface
     */
    protected $cache = null;

    /**
     * Model from which the data will be queried
     *
     * @var Model
     */
    protected $model = null;


    /**
     * Compose the View
     *
     * @param View $view
     *
     * @return mixed
     */
    abstract function compose(View $view);

}
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
     * compose the view
     *
     * @param View $view
     *
     * @return mixed
     */
    abstract public function compose(View $view);

}
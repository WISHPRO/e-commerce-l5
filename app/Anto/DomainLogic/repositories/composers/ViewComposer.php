<?php namespace app\Anto\domainLogic\repositories\composers;

use Illuminate\View\View;

abstract class ViewComposer
{

    /**
     * The name of the output variable
     * It will be sent to the respective view
     */
    protected $outputVariable = null;

    protected $cache = null;

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
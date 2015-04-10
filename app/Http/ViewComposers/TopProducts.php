<?php namespace app\http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use app\Antony\DomainLogic\Modules\Product\Base\Products;

class TopProducts extends ViewComposer
{
    /**
     * output variable name
     *
     * @var string
     */
    protected $outputVariable = 'topProducts';

    /**
     * @param CacheInterface $cacheInterface
     * @param Products $repository
     */
    public function __construct(CacheInterface $cacheInterface, Products $repository)
    {

        $this->cache = $cacheInterface;

        $this->dataSource = $repository;

        $this->cache->setMinutes(config('site.composers.cache_duration', 10));
    }

    /**
     * Gets the data to display in the view
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->dataSource->displayTopRated();
    }
}
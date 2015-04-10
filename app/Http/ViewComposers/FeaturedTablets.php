<?php namespace app\Http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use app\Antony\DomainLogic\Modules\SubCategories\Base\SubCategories;

class FeaturedTablets extends ViewComposer
{

    /**
     * output variable name
     *
     * @var string
     */
    protected $outputVariable = 'featuredTablets';

    /**
     * @param CacheInterface $cacheInterface
     * @param SubCategories $repository
     */
    public function __construct(CacheInterface $cacheInterface, Subcategories $repository)
    {
        $this->dataSource = $repository;

        $this->cache = $cacheInterface;

        $this->cache->setMinutes(config('site.composers.cache_duration', 10));
    }

    /**
     * Gets the data to display in the view
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->dataSource->displayFeaturedTablets();
    }
}
<?php namespace app\Anto\Composers;

use app\Anto\Repositories\CachingRepository;
use Carbon\Carbon;

abstract class ViewComposer implements CachingRepository
{

    /**
     * The name of the output variable
     * It will be sent to the respective view
     */
    protected $outputVariable = null;

    /**
     * Renders the view
     *
     * @param $view
     */
    public function compose($view)
    {
        // check if caching is enabled, do the necessary
        if ($this->cachingEnabled()) {
            if ($this->cachehasData()) {
                $view->with($this->outputVariable, $this->retrieveCachedData());
            } else {
                // empty cache. refill, with required data
                $data = $this->fillComposer();

                $this->cacheData($data);

                $view->with($this->outputVariable, $data);
            }
        }

        $view->with($this->outputVariable, $this->fillComposer());
    }

    /**
     * This function will allow us to fill the composer with data, from a source
     *
     * @return mixed
     */
    abstract protected function fillComposer();

    /**
     * Cache the composer data
     *
     * @param $data
     *
     * @return mixed|void
     */
    public function cacheData($data)
    {
        \Cache::put(
            $this->outputVariable,
            $data,
            Carbon::now()->addMinutes(composerCachingDuration())
        );
    }

    /**
     * Checks if caching has been enabled
     *
     * @return mixed
     */
    function cachingEnabled()
    {
        return composerCachingEnabled();
    }

    /**
     * Allows us to get the cached data
     *
     * @return mixed
     */
    function retrieveCachedData()
    {
        return \Cache::get($this->outputVariable);
    }

    /**
     * Allows us to determine if the cache has any data
     *
     * @return bool
     */
    function cachehasData()
    {
        return \Cache::has($this->outputVariable);
    }
}
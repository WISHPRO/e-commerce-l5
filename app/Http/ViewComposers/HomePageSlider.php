<?php namespace app\Http\ViewComposers;

use app\Anto\DomainLogic\contracts\CacheInterface;
use app\Anto\DomainLogic\repositories\Ads\AdvertisementsRepo;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use Illuminate\View\View;

class HomePageSlider extends ViewComposer
{

    protected $model;


    /**
     * @param CacheInterface $cacheInterface
     * @param AdvertisementsRepo $repository
     */
    public function __construct(CacheInterface $cacheInterface, AdvertisementsRepo $repository)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;
    }

    /**
     * compose the view
     *
     * @param View $view
     *
     * @return mixed
     */
    public function compose(View $view)
    {
        $key = hash('sha1', 'sliders');

        if ($this->cache->has($key)) {
            $view->with('sliders', $this->cache->get($key));

        } else {

            $data = $this->model->retrieveMultiple();

            $this->cache->put($key, $data, 10);

            $view->with('sliders', $data);
        }
    }
}
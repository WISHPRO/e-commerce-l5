<?php namespace app\http\ViewComposers;

use app\Anto\DomainLogic\contracts\CacheInterface;
use app\Anto\DomainLogic\repositories\Ads\AdvertisementsRepo;
use app\Anto\domainLogic\repositories\CategoriesRepository;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Models\Category;
use Illuminate\View\View;

class CategoryList extends ViewComposer
{

    protected $model;

    protected $ads;

    /**
     * @param CacheInterface $cacheInterface
     * @param CategoriesRepository $repository
     */
    public function __construct(CacheInterface $cacheInterface, CategoriesRepository $repository, AdvertisementsRepo $advertisementsRepo)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;

        $this->ads = $advertisementsRepo;
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
        $key = hash('sha1', 'categories');

        if ($this->cache->has($key)) {
            $view->with('categories', $this->cache->get($key));

        } else {

            $data = $this->model->displayCategories();

            // $category->adverts->where('category_id', $category->id)->implode('id')
            $this->cache->put($key, $data, 10);

            $view->with('categories', $data);
        }
    }
}
<?php namespace app\Anto\DomainLogic\repositories\Ads;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\Ads;

class AdvertisementsRepo extends EloquentDataAccessRepository
{

    /**
     * @param Ads $ads
     */
    public function __construct(Ads $ads)
    {
        $this->model = $ads;
    }

    /**
     * Create an advertisement
     *
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        $data = array_add($data, 'id', str_random(30));

        return parent::add($data);
    }

    /**
     * Attempts to resolve an advertisement to its parent. A parent could be a category, product, etc
     *
     * @param $id
     *
     * @return array|mixed
     */
    public function resolve($id)
    {
        // find the actual advertisement in the db
        // Returning null from the find will allow us to handle the 'not found issue' cleanly,
        // instead of just throwing an exception / 404, which is kind of 'unhealthy' to the user, after they click an advertisement
        $ad = parent::find($id, [], false);

        if (is_null($ad)) {
            return null;
        }
        if ($ad->category_id == null) {
            return ['product' => $ad->product_id];
        }
        if ($ad->product_id == null) {
            return ['category' => $ad->category_id];
        }
        return ['product' => $ad->product_id, 'category' => $ad->category_id];
    }
}
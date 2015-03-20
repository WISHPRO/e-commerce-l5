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
     * @param $id
     *
     * @return array|mixed
     */
    public function resolve($id)
    {
        $ad = parent::find($id);

        if ($ad->category_id == null) {
            return ['product' => $ad->product_id];
        }
        if ($ad->product_id == null) {
            return ['category' => $ad->category_id];
        }
        return ['product' => $ad->product_id, 'category' => $ad->category_id];
    }
}
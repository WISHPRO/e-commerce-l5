<?php namespace app\Anto\DomainLogic\repositories\Ads;

use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\Ads;

class AdvertisementsRepo extends DataAccessRepository
{

    public function __construct(Ads $ads)
    {
        $this->model = $ads;
    }

    public function add($data)
    {
        $data = array_add($data, 'id', str_random(20));

        return parent::add($data);
    }
}
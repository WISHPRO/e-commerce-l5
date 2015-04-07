<?php namespace app\Antony\DomainLogic\Modules\Counties\Base;

use App\Antony\DomainLogic\Modules\Counties\CountiesRepository;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;

class Counties extends DataAccessLayer
{

    protected $objectName = 'counties';

    /**
     * @param CountiesRepository $countiesRepository
     */
    public function __construct(CountiesRepository $countiesRepository)
    {

        parent::__construct($countiesRepository);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate();
    }
}
<?php namespace app\Antony\DomainLogic\Modules\User\Reports;

use app\Antony\DomainLogic\Modules\User\Base\Users;

class UserReports extends Users
{

    /**
     * @return mixed
     */
    public function getUsersByCounty()
    {
        $users = $this->repository->with(['county'])->get();

        // county ----- user
        return $users->toJson(JSON_PRETTY_PRINT);
    }
}
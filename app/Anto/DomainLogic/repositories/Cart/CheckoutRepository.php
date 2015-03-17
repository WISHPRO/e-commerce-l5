<?php namespace app\Anto\DomainLogic\repositories\Cart;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\Checkout;

class CheckoutRepository extends EloquentDataAccessRepository
{

    public function __construct(Checkout $checkout)
    {
        parent::__construct($checkout);
    }


}
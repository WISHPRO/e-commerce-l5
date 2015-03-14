<?php namespace app\Anto\DomainLogic\repositories\Cart;

use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\Checkout;

class CheckoutRepository extends DataAccessRepository
{

    public function __construct(Checkout $checkout)
    {
        parent::__construct($checkout);
    }


}
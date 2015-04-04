<?php namespace app\Antony\DomainLogic\Contracts\ShoppingCart;

interface ShoppingResult
{

    const PRODUCT_ADDED = 'product.added';

    const PRODUCT_UPDATED = 'product.updated';

    const ADD_PRODUCT_FAILED = 'product.addtocart.failed';

    const UPDATE_PRODUCT_FAILED = 'product.update.failed';
}
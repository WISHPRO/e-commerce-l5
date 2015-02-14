<?php namespace app\Http\Controllers\Backend;

use app\Anto\Traits\ProductTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;

class BackendProductsController extends Controller
{
    use ProductTrait;

}

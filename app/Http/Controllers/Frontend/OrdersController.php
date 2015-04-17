<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Orders\Base\Orders;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\SubmitOrderRequest;
use Illuminate\Http\Response;

class OrdersController extends Controller
{
    /**
     * @var Orders
     */
    private $orders;

    /**
     * @param Orders $orders
     */
    public function __construct(Orders $orders)
    {

        $this->orders = $orders;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubmitOrderRequest $orderRequest
     *
     * @return Response
     */
    public function store(SubmitOrderRequest $orderRequest)
    {
        return $this->orders->placeOrder($orderRequest->except('_token'))->createInvoice(null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}

<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Orders\Base\Orders;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Orders\SubmitOrderRequest;
use Barryvdh\DomPDF\PDF;
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
        return view('frontend.Orders.index');
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
        return $this->orders->placeOrder($orderRequest->except('_token'))->createInvoice();
    }

    /**
     * @return $this
     */
    public function displayInvoice()
    {

        $data = $this->orders->invoice_data();

        return view('frontend.Orders.displayInvoice')
            ->with('order', array_get($data, '0'))
            ->with('products', array_get($data, '2'))
            ->with('user', array_get($data, '1'));
    }

    public function downloadInvoice()
    {
        $pdf = PDF::loadView('frontend.Orders.displayInvoice', $data);
        return $pdf->download('invoice.pdf');
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

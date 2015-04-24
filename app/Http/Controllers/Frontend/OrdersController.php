<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Orders\Base\Orders;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Orders\SubmitOrderRequest;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
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

        $this->middleware('auth', ['except' => ['store', 'displayInvoice', 'printInvoice']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = $this->orders->displayUserOrders($request->user()->getAuthIdentifier());

        return view('frontend.Orders.viewMyOrders', compact('data'));
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

        $order = array_get($data, '0');
        $cart_data = array_get($data, '2');
        $user = array_get($data, '1');

        return view('frontend.Orders.displayInvoice', compact('order', 'cart_data', 'user'));
    }

    /**
     * @return Response
     */
    public function printInvoice()
    {
        $data = $this->orders->invoice_data();

        $order = array_get($data, '0');
        $cart_data = array_get($data, '2');
        $user = array_get($data, '1');

        $pdf = \PDF::loadView('frontend.Orders.displayInvoice', compact('order', 'cart_data', 'user'));

        return $pdf->stream();
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

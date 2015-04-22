<?php namespace app\Antony\DomainLogic\Modules\Orders\Base;

use app\Antony\DomainLogic\Contracts\Invoice\InvoiceContract;
use app\Antony\DomainLogic\Contracts\Orders\ProductOrderContract;
use app\Antony\DomainLogic\Modules\Cookies\CheckOutCookie;
use app\Antony\DomainLogic\Modules\Cookies\OrderCookie;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\Guests\GuestRepository;
use app\Antony\DomainLogic\Modules\Invoices\base\InvoiceRepository;
use app\Antony\DomainLogic\Modules\Invoices\InvoicingTrait;
use app\Antony\DomainLogic\Modules\Orders\OrdersRepository;
use app\Antony\DomainLogic\Modules\ShoppingCart\ShoppingCart;

class Orders extends DataAccessLayer implements ProductOrderContract, InvoiceContract
{
    use InvoicingTrait;

    protected $order;

    /**
     * @var ShoppingCart
     */
    protected $shoppingCart;

    /**
     * @var GuestRepository
     */
    protected $checkoutCookie;

    /**
     * @var InvoiceRepository
     */
    protected $invoiceRepository;

    /**
     * @var OrderCookie
     */
    private $orderCookie;

    protected $orderCookieData;

    /**
     * @param OrdersRepository $OrdersRepository
     * @param ShoppingCart $shoppingCart
     * @param CheckOutCookie $checkoutCookie
     */
    public function __construct(OrdersRepository $OrdersRepository, ShoppingCart $shoppingCart, CheckOutCookie $checkoutCookie, InvoiceRepository $invoiceRepository, OrderCookie $orderCookie)
    {

        $this->repository = $OrdersRepository;
        $this->shoppingCart = $shoppingCart;
        $this->checkoutCookie = $checkoutCookie;
        $this->invoiceRepository = $invoiceRepository;
        $this->orderCookie = $orderCookie;
    }

    /**
     * Ok, this presents a commonly used implementation of a SELECT procedure
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        // display all orders in the system
        return $this->repository->paginate(['users', 'products']);
    }

    /**
     * @param $user_id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function displayUserOrders($user_id)
    {
        return $this->repository->with(['users', 'products'])->where('user_id', $user_id)->get();
    }

    /**
     * @param $guest_id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function displayGuestOrders($guest_id)
    {
        return $this->repository->with(['guests', 'products'])->where('guest_id', $guest_id)->get();
    }

    /**
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleRedirect($request)
    {
        switch ($this->getResult()) {

            case static::CREATE_SUCCESS: {
                if ($request->ajax()) {

                    return response()->json(['message' => "Your order was processed successfully. we've sent you an invoice to your email address"]);
                } else {

                    flash()->overlay("Your order was processed successfully. we've sent you an invoice to your email address", "Order Information");

                    return redirect()->route('checkout.viewInvoice');
                }
            }
            case static::CREATE_FAILED: {
                if ($request->ajax()) {

                    return response()->json(['message' => "Your order could not be processed at this time. Please try again later"], 422);
                } else {

                    flash()->error("Your order could not be processed at this time. Please try again later");

                    return redirect()->back();
                }
            }
            case static::INVOICE_CREATED: {
                if ($request->ajax()) {

                    return response()->json(['message' => "Your order was successfully processed. Here's your invoice"]);
                } else {

                    flash("Your order was successfully processed. Here's your invoice");

                    return redirect()->back();
                }
            }
        }
        return redirect()->back();
    }


    /**
     * @param $data
     *
     * @return $this
     */
    public function placeOrder($data)
    {
        $products = $this->shoppingCart->retrieveProductsInCart();
        $data = [
            'product_data' => $products,
            'user_data' => array_get($this->checkoutCookie->fetch()->get(), 'data'),
        ];

        $this->order = $this->repository->add($data);

        is_null($this->order) ? $this->setResult(static::CREATE_FAILED) : $this->setResult(static::CREATE_SUCCESS);

        $this->saveOrderInCookie(null);

        return $this;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function saveOrderInCookie($data)
    {
        $this->orderCookie->cookie->queue($this->orderCookie->name, $this->order, $this->orderCookie->timespan);
    }

    /**
     * @return array|null
     */
    public function getCookieData()
    {
        $cookieData = $this->orderCookie->fetch()->get();

        $this->orderCookieData = $cookieData;

        return $this->orderCookieData;
    }

    /**
     * @param $order_id
     *
     * @return mixed
     */
    public function cancel($order_id)
    {
        // TODO: Implement cancel() method.
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDataForInvoice()
    {

        $data = $this->repository->with([is_null(auth()) ? 'guests' : 'users', 'products'])->where('id', '=', session('order'))->get();

        return $data;
    }

    /**
     * @param null $order_id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getOrderData($order_id = null)
    {
        $data = $this->repository->getFirstBy('id', '=', is_null($order_id) ? $this->order->id : $order_id, ['guests', 'users.county', 'products'])->get();

        return $data;
    }
}
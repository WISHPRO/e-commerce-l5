<?php namespace app\Antony\DomainLogic\Modules\Orders\Base;

use app\Antony\DomainLogic\Contracts\Orders\ProductOrderContract;
use app\Antony\DomainLogic\Modules\Cookies\CheckOutCookie;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\Guests\GuestRepository;
use app\Antony\DomainLogic\Modules\Orders\OrdersRepository;
use app\Antony\DomainLogic\Modules\ShoppingCart\ShoppingCart;
use App\Events\OrderWasSubmitted;

class Orders extends DataAccessLayer implements ProductOrderContract
{

    protected $order;

    /**
     * @var ShoppingCart
     */
    private $shoppingCart;

    /**
     * @var GuestRepository
     */
    private $checkoutCookie;

    /**
     * @param OrdersRepository $OrdersRepository
     * @param ShoppingCart $shoppingCart
     * @param CheckOutCookie $checkoutCookie
     */
    public function __construct(OrdersRepository $OrdersRepository, ShoppingCart $shoppingCart, CheckOutCookie $checkoutCookie)
    {

        $this->repository = $OrdersRepository;
        $this->shoppingCart = $shoppingCart;
        $this->checkoutCookie = $checkoutCookie;
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

                    return redirect()->back();
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

        $this->saveOrderInSession(null);

        return $this;
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
     * @param $data
     *
     * @return mixed
     */
    public function createInvoice($data)
    {
        $data = $this->repository->with([is_null(auth()) ? 'guests' : 'users', 'products'])->where('id', '=', $this->order->id)->get();
        dd($data);
    }

    /**
     * @return mixed
     */
    public function sendInvoice()
    {
        $mailResult = event(new OrderWasSubmitted($this->order));
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function saveOrderInSession($data)
    {
        session(["order{$this->order->id}" => $this->order->id]);
    }
}
<?php namespace app\Antony\DomainLogic\Modules\Orders\Base;

use app\Antony\DomainLogic\Modules\Cookies\CheckOutCookie;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\Guests\GuestRepository;
use app\Antony\DomainLogic\Modules\Orders\OrdersRepository;
use app\Antony\DomainLogic\Modules\ShoppingCart\ShoppingCart;

class Orders extends DataAccessLayer
{

    /**
     * @var ShoppingCart
     */
    private $shoppingCart;
    /**
     * @var GuestRepository
     */
    private $checkoutCookie;

    protected $order;

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
     * @param $data
     *
     * @return $this
     */
    public function create($data)
    {
        $products = $this->shoppingCart->retrieveProductsInCart();
        $data = [
            'product_data' => $products,
            'user_data' => array_get($this->checkoutCookie->fetch()->get(), 'data'),
        ];

        return parent::create($data);
    }

    /**
     * Ok, this presents a commonly used implementation of a SELECT procedure
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

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
        }
    }
}
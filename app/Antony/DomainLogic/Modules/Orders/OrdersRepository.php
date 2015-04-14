<?php namespace app\Antony\DomainLogic\Modules\Orders;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use app\Models\Order;

class OrdersRepository extends EloquentDataAccessRepository
{

    protected $orderID;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {

        $this->model = $order;
    }

    /**
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        $this->model->creating(function ($order) use ($data) {

            $order->id = $this->generateOrderId();

            // add the total cost of the order
            $order->total_cost = array_get($data, 'product_data')->getGrandTotal(false);
        });

        $this->performSync($data);

        $order = parent::add([]);

        $this->orderID = $order->id;

        return $order;
    }

    /**
     * @return string
     */
    public function generateOrderId()
    {
        return int_random();
    }

    /**
     * @param $data
     */
    public function performSync($data)
    {
        $productData = array_get($data, 'product_data');

        $userData = array_get($data, 'user_data');

        // handle the model created event
        $this->model->created(function ($order) use ($productData, $userData) {

            // add each product to the join table => order_product
            $productData->products->each(function ($product) use ($order, $productData) {

                $order->products()->attach([$product->id], ['quantity' => $productData->getSingleProductQuantity($product)], [$order->id]);

            });

            // add user/guest info to the join table => order_user
            if (!is_null(auth())) {
                // user
                $order->users()->attach([auth()->user()->getAuthIdentifier()], ['order_id' => $order->id]);
            } else {

                // guest
                $order->guests()->attach([$userData]);
            }

        });
    }
}
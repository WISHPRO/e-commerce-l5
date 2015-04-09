<?php namespace app\Antony\DomainLogic\Modules\ShoppingCart;

use app\Antony\DomainLogic\Contracts\Redirects\AppRedirector;
use app\Antony\DomainLogic\Contracts\ShoppingCart\ShoppingCartContract;
use app\Antony\DomainLogic\Modules\Cookies\ShoppingCartCookie;
use App\Antony\DomainLogic\Modules\Product\ProductRepository;
use App\Antony\DomainLogic\Modules\ShoppingCart\Base\CartRepository;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ShoppingCart implements ShoppingCartContract, AppRedirector
{

    /**
     * @var int
     */
    protected $newQuantity;

    /**
     * @var int
     */
    protected $oldQuantity;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var mixed
     */
    protected $productID;

    /**
     * @var Product
     */
    protected $productAddedToCart;

    /**
     * @var string
     */
    protected $shoppingResult;

    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var ShoppingCartCookie
     */
    private $cartCookie;

    /**
     * @var ProductRepository
     */
    private $productRepository;


    /**
     * @param CartRepository $cartRepository
     * @param ShoppingCartCookie $applicationCookie
     * @param ProductRepository $productRepository
     */
    public function __construct(CartRepository $cartRepository, ShoppingCartCookie $applicationCookie, ProductRepository $productRepository)
    {

        $this->cartRepository = $cartRepository;
        $this->cartCookie = $applicationCookie;
        $this->productRepository = $productRepository;

    }

    /**
     * Creates a user's shopping cart
     *
     * @param $request
     * @param $productID
     *
     * @return $this
     */
    public function create($request, $productID)
    {
        // determine the quantity we have
        $this->determineProductQuantity($request);

        // create the shopping cart
        $this->cart = $this->cartRepository->createIfDoesNotExist($request->except('_token', 'quantity'));

        // determine the number of products in this cart
        $this->getExistingProductQuantity($productID);

        // check if quantity is >=0 , and do the necessary
        if ($this->oldQuantity > 0) {

            // this product exists in the shopping cart. so we update its quantity
            $this->updateExistingProductQuantity();

            return $this;

        } else {

            // cart doesn't have this product, so we add it
            $this->addProduct();

            $this->createShoppingCartCookie();

            return $this;
        }
    }

    /**
     * Returns the quantity of a product submitted by a user
     *
     * @param $request
     *
     * @return int
     */
    public function determineProductQuantity($request)
    {
        $this->newQuantity = $request->get('quantity') != null ? $request->get('quantity') : 1;

        return $this->newQuantity;
    }

    /**
     * Gets the quantity of an existing product in the shopping cart
     *
     * @param $productID
     *
     * @return int|mixed
     */
    public function getExistingProductQuantity($productID)
    {
        $this->productID = $productID;
        $this->oldQuantity = $this->cartRepository->getExistingQuantity($productID);

        return $this->oldQuantity;
    }

    /**
     * Updates the quantity of an existing product in the shopping cart
     */
    public function updateExistingProductQuantity()
    {
        if ($this->cartRepository->updateExistingQuantity($this->oldQuantity, $this->newQuantity, $this->productID) === null) {
            $this->setShoppingCartResult(ShoppingCartContract::UPDATE_PRODUCT_FAILED);
        }
        $this->setShoppingCartResult(ShoppingCartContract::PRODUCT_UPDATED);
    }

    /**
     * Adds a product to the user's shopping cart
     */
    public function addProduct()
    {
        if ($this->cartRepository->addProducts($this->productID, $this->newQuantity) === null) {

            $this->setShoppingCartResult(ShoppingCartContract::ADD_PRODUCT_FAILED);
        }
        $this->setShoppingCartResult(ShoppingCartContract::PRODUCT_ADDED_TO_CART);
    }

    /**
     * Queues a cookie to be sent with the next response from our application
     */
    public function createShoppingCartCookie()
    {
        $this->cartCookie->cookie->queue($this->cartCookie->name, $this->cart, $this->cartCookie->timespan);
    }

    /**
     * Handle a redirect after a user performs some action
     *
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleRedirect($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        switch ($this->shoppingResult) {

            case ShoppingCartContract::PRODUCT_UPDATED: {

                if ($request->ajax()) {
                    return response()->json(['message' => 'This product was already in your shopping cart. Its quantity was updated to ' . $this->getUpdatedQuantity(), 'target' => url(route('cart.view'))]);
                } else {
                    flash()->overlay(
                        "This product was already in your cart. We've updated the quantity to " . $this->getUpdatedQuantity(),
                        "Shopping cart information"
                    );

                    return redirect()->back();
                }

            }
            case ShoppingCartContract::UPDATE_PRODUCT_FAILED: {
                if ($request->ajax()) {
                    return response()->json(['message' => 'An error occurred while trying to update your shopping cart. Please try again'], 422);
                } else {
                    flash()->error('An error occurred while trying to update your shopping cart. Please try again');

                    return redirect()->back();
                }

            }
            case ShoppingCartContract::PRODUCT_ADDED_TO_CART: {
                if ($request->ajax()) {
                    return response()->json(['message' => 'The product was successfully added to your shopping cart', 'target' => url(route('cart.view'))]);
                } else {
                    flash()->overlay('The product was successfully added to your shopping cart', "Shopping cart information");

                    return redirect()->route('cart.view');
                }
            }
            case ShoppingCartContract::ADD_PRODUCT_FAILED: {
                if ($request->ajax()) {
                    return response()->json(['message' => 'An error occurred while trying to add the product to your shopping cart. Please try again'], 422);
                } else {
                    flash()->error('An error occurred while trying to add the product to your shopping cart. Please try again');

                    return redirect()->back();
                }
            }
            case ShoppingCartContract::CART_PRODUCT_UPDATED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'The quantity was successfully updated']);
                } else {
                    flash('The quantity was successfully updated');

                    return redirect()->back();
                }

            }
            case ShoppingCartContract::CART_PRODUCT_UPDATE_FAILED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Updating this product failed. Please try again'], 422);
                } else {

                    flash()->error('Updating this product failed. Please try again');
                    return redirect()->back();
                }

            }
            case ShoppingCartContract::CART_REMOVE_PRODUCT_FAILED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'The product was not removed from your shopping cart. Please try again'], 422);
                } else {

                    flash()->error('The product was not removed from your shopping cart. Please try again');
                    return redirect()->back();
                }

            }
            case ShoppingCartContract::CART_REMOVE_PRODUCT_SUCCESS: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'The product was successfully removed from your shopping cart']);
                } else {

                    flash('The product was successfully removed from your shopping cart');

                    return redirect()->back();
                }

            }
        }
        return redirect()->back();
    }

    /**
     * Returns the sum of existing + new product quantities
     *
     * @return mixed
     */
    public function getUpdatedQuantity()
    {
        return $this->newQuantity + $this->oldQuantity;
    }

    /**
     * Retrieves products in a user's shopping cart
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function retrieveProductsInCart()
    {
        $cart = $this->cartRepository->find($this->cartCookie->fetch()->get()->id);

        if ($cart->hasItems()) {

            return $cart;
        }
        return null;
    }

    /**
     * Updates a user's shopping cart
     *
     * @param $request
     * @param $productID
     *
     * @return $this
     */
    public function updateShoppingCart($request, $productID)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        // get the cart from the cookie
        $cartID = $this->cartCookie->fetch()->get()->id;

        // verify that it exists in the database
        $this->cart = $this->cartRepository->find($cartID, false);

        // check the quantity
        $this->oldQuantity = $this->cartRepository->getExistingQuantity($productID);

        // get the new quantity from the request
        $newQT = $request->get('quantity');

        // update the cart
        $result = $this->cartRepository->updateExistingQuantity($this->oldQuantity, $newQT, $productID, true);

        if (is_null($result)) {

            $this->setShoppingCartResult(ShoppingCartContract::CART_PRODUCT_UPDATE_FAILED);

            return $this;
        } else {

            $this->setShoppingCartResult(ShoppingCartContract::CART_PRODUCT_UPDATED);

            return $this;
        }

    }

    /**
     * Removes a product from a user's shopping cart
     *
     * @param $productID
     *
     * @return $this
     */
    public function removeProduct($productID)
    {
        $this->cartRepository->setCartID($this->cartCookie->fetch()->get()->id);

        if (is_null($this->cartRepository->detach($productID))) {

            $this->setShoppingCartResult(ShoppingCartContract::CART_REMOVE_PRODUCT_FAILED);

            return $this;
        }

        $this->setShoppingCartResult(ShoppingCartContract::CART_REMOVE_PRODUCT_SUCCESS);

        return $this;
    }

    /**
     * @return string
     */
    public function getShoppingCartResult()
    {
        return $this->shoppingResult;
    }

    /**
     * @param string $shoppingResult
     */
    protected function setShoppingCartResult($shoppingResult)
    {
        $this->shoppingResult = $shoppingResult;
    }
}
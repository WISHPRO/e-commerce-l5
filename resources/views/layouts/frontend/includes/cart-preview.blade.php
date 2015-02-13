<div class="col-xs-12 col-sm-12 col-md-4 animate-dropdown top-cart-row pull-right">
    <div class="dropdown dropdown-cart">
        @if(!is_null(Cookie::get('shopping_cart')))
            @if(!array_get($data, 'cart_items')->isEmpty())
                @foreach($cart_items = array_get($data, 'cart_items') as $cart)
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="total-price-basket">
                                <span class="lbl">
                                    cart -
                                </span>
                                <span class="total-price">
                                    <span class="curr-sym">
                                        Ksh
                                    </span>
                                    <span class="value">
                                        {{ getCartSubTotal($cart) }}
                                    </span>
                                </span>
                            </div>
                            <div class="basket">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </div>
                            <div class="basket-item-count">
                                <span class="count">{{ $cart->products()->count() }}</span>
                            </div>
                        </div>
                    </a>
                <ul class="dropdown-menu">
                    @foreach($cart->products->unique() as $product)
                        <li>
                        <div class="cart-item product-summary">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="image">
                                        <a href="{{ route('cart.view') }}">
                                            <img src="{{ ImageExists($product->image) ? asset($product->image) : Config::get('_images.static.error') }}" class="cart-image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <h3 class="name">
                                        <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                            {{{ $product->name }}}
                                        </a>
                                    </h3>
                                    <div class="price">
                                        <span class="curr-sym">Ksh</span>
                                        {{ hasDiscount($product) ? calculateDiscount($product, true) : $product->price }}
                                    </div>
                                </div>
                                <div class="col-xs-1 action">
                                    <a href="{{ route('cart.update.remove', ['productID' => $product->id]) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                        <!-- /.cart-item -->
                        <div class="clearfix"></div>
                        <hr>
                        <div class="clearfix cart-total">
                            <div class="pull-right">
                                <span class="text">Sub Total :</span>
                                <span class='price'>
                                    <span class="curr-sym">Ksh</span>
                                    {{ getCartSubTotal($cart) }}
                                </span>
                            </div>
                            <div class="clearfix"></div>
                            <a href="{{ route('checkout.start') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                        </div>
                </ul>
                @endforeach
            @else

                 @include('layouts.frontend.includes.empty_cart')

            @endif
            @else

            @include('layouts.frontend.includes.empty_cart')

        @endif
    </div>
</div>
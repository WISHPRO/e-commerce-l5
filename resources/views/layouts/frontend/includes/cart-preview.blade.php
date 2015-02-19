<div class="col-xs-12 col-sm-12 col-md-4 animate-dropdown top-cart-row pull-right">
    <div class="dropdown dropdown-cart">
        @if(shoppingCartExists())
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
                                <span class="count">{{ getTotalBasketCount($cart) }}</span>
                            </div>
                        </div>
                    </a>
                <ul class="dropdown-menu">
                    @foreach($cart->products as $product)
                        <li>
                        <div class="cart-item product-summary">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="image">
                                        <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                            <img src="{{ displayImage($product) }}" class="cart-image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <h3 class="name">
                                        <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                            {{ beautify($product->name) }}
                                        </a>
                                    </h3>
                                    <span class="text">
                                        Quantity: <span class="text text-danger">{{ getCartPQt($product) }}</span>
                                    </span>
                                    <div class="price">
                                        <span class="curr-sym">Ksh</span>
                                        {{ getProductPrice($product) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                        <hr/>
                    @endforeach
                        <!-- /.cart-item -->
                        <div class="clearfix"></div>

                        <div class="clearfix cart-total">
                            <div class="pull-right">
                                <span class="text">Sub Total :</span>
                                <span class='price'>
                                    <span class="curr-sym">Ksh</span>
                                    {{ getCartSubTotal($cart) }}
                                </span>
                            </div>
                            <div class="clearfix"></div>
                            <a href="{{ route('cart.view') }}" class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a>
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
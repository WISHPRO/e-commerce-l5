@foreach($cartItems as $cart)
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-shopping-cart nav-icon"></i>
            Cart <span class="basket-item-count">
                ({{ $cart->getTotalBasketCountByExistingQuantity() }} items)
            </span> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <div class="shopping-cart">
                    @foreach($cart->products as $product)
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                    <img src="{{ displayImage($product) }}" class="cart-image">
                                </a>
                            </div>
                            <div class="col-xs-8">
                                <p class="text text-muted">
                                    <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                        {{ beautify($product->name) }}
                                    </a>
                                </p>
                                                            <span class="text pull-left">
                                                                <span class="text text-danger">{{ $cart->getSingleProductQt($product) }}</span> item(s)
                                                            </span>
                                &nbsp;
                                <div class="pull-right">
                                    <span class="curr-sym">Ksh</span>
                                    {{ $cart->getProductPrice($product) }}
                                </div>
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                    <div class="col-xs-12 m-t-5">
                        <span class="text text-muted bold pull-left">Sub Total : &nbsp;</span>
                                                    <span class='bold pull-right'>
                                                        <span class="curr-sym">Ksh</span>
                                                        {{ $cart->cartSubTotal() }}
                                                    </span>
                    </div>
                    <div class="clearfix"></div>
                    <a href="{{ route('cart.view') }}" class="btn btn-upper btn-primary btn-block m-t-10">View Shopping
                        Cart ({{ $cart->getTotalBasketCountByExistingQuantity() }} items)</a>
                </div>
            </li>

        </ul>
    </li>
@endforeach
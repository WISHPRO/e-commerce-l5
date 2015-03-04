<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-shopping-cart nav-icon"></i>
        Cart <span class="basket-item-count">(0 items)</span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="shopping-cart">

                <div class="alert alert-warning">
                    <p>Are you missing items in your cart?</p>
                    <br/>
                    {!! link_to_route('login', 'Log In')!!} to see items you may have added from another computer or
                    device.
                </div>
                <a href="{{ route('cart.view') }}">
                    <button class="btn btn-primary btn-block m-t-5">
                        View Shopping Cart
                        (0 items)
                    </button>
                </a>
            </div>
        </li>
    </ul>
</li>
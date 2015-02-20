<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-shopping-cart nav-icon"></i>
        Cart <span class="basket-item-count">(0 items)</span> <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="shopping-cart">

                <div class="alert alert-info">
                    <p>Are you missing items in your cart?</p>
                    <br/>
                    {!! link_to_route('login', 'Log In')!!} to see items you may have added from another computer or device.
                </div>
                <a href="{{ route('cart.view') }}" class="btn btn-upper btn-primary btn-block m-t-5">View Shopping Cart (0 items)</a>
            </div>
        </li>
    </ul>
</li>
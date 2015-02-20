<ul class="dropdown-menu">
    <li>
        <a href="{{ route('my_cart') }}">
            <i class="fa fa-shopping-cart account"></i>
            Your shopping cart
        </a>
    </li>
    <li>
        <a href="{{ route('mywishlist') }}">
            <i class="fa fa-heart account"></i>
            Your wishlist
        </a>
    </li>
    <li>
        <a href="{{ route('my_orders') }}">
            <i class="fa fa-laptop account"></i>
            Your orders
        </a>
    </li>
    <li>
        <a href="{{ route('my_order_trail') }}">
            <i class="fa fa-history account"></i>
            Your order history
        </a>
    </li>
    <li>
        <a href="{{ route('myaccount') }}">
            <i class="fa fa-user account"></i>
            Your Account
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="{{ route('logout') }}">
            <button class="btn btn-upper btn-danger btn-block m-t-5">
                <i class="fa fa-sign-out "></i> Log out
            </button>

        </a>
    </li>
</ul>
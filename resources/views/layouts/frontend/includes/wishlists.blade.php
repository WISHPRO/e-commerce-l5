<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                class="fa fa-heart nav-icon"></i> Wishlist <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ Auth::check() ? route('mywishlist.create') : route('wishlist')}}">
                <i class="fa fa-plus nav-icon"></i> Create a wishlist
            </a>
        </li>
        <li>
            <a href="{{ Auth::check() ? route('mywishlist') : route('wishlist') }}">
                <i class="fa fa-heart nav-icon"></i> View my wishlists
            </a>
        </li>
    </ul>
</li>
<nav class="navbar navbar-inverse navbar-static-top yamm" id="2cnd" role="navigation"
     style="z-index: auto; margin-bottom: 0">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#site-navigation-bar-main">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand site-logo" href="{{ route('home') }}">PC-WORLD</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="site-navigation-bar-main" style="padding-right: 10px">
        <ul class="nav navbar-nav">
            @foreach($categories as $category)
                <li class="dropdown yamm">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ beautify($category->name) }}<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <ul class="links">
                                                @foreach($category->subcategories as $subcategory)
                                                    <li>
                                                        <a href="{{ route('f.subcategories.view', ['id' => $subcategory->id, 'name' => preetify($subcategory->name)]) }}">{{ $subcategory->name }}</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        @if(!$category->adverts->isEmpty())
                                            <?php $ad = $category->getAdvert() ?>
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <div class="row">
                                                    <a href="{{ route('ads.product', ['advert' => $ad->id ]) }}">
                                                        <img class="nav-add img-responsive img-thumbnail"
                                                             src="{{ asset($ad->image) }}">
                                                    </a>
                                                </div>

                                            </div>
                                            @endif
                                                    <!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.yamm-content -->
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-shopping-cart cart-icon"></i>
                    &nbsp;<span class="item-count">({{ !empty($cart) ? $cart->getAllProductsQuantity() : "0" }})</span>
                    <span class="caret"></span>
                </a>
                @if(empty($cart))
                    <ul class="dropdown-menu" style="right: 25px" role="menu">
                        <li>
                            <div class="shopping-cart">
                                <div class="alert alert-warning">
                                    <p>Your shopping cart is empty. Give it purpose by filling it with items</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                @else

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <div class="shopping-cart">
                                @foreach($cart->products as $product)
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                <img src="{{ displayImage($product) }}" class="cart-image">
                                            </a>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="text text-muted">
                                                <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                    {{ $product->name() }}
                                                </a>
                                            </p>
                                                                <span class="text pull-left">
                                                                    <span class="text text-danger">{{ $cart->getSingleProductQuantity($product) }}</span> item(s)
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
                                                            {{ $cart->getSubTotal() }}
                                                        </span>
                                </div>
                                <div class="clearfix"></div>
                                <a href="{{ route('cart.view') }}">
                                    <button class="btn btn-primary btn-block m-t-10">
                                        View Shopping Cart ({{ $cart->getAllProductsQuantity() }} items)
                                    </button>
                                </a>
                            </div>
                        </li>
                    </ul>
                @endif
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::check() ? Auth::user()->getUserName() : "Login&nbsp;/&nbsp;Register" }}
                    <b class="caret"></b>
                    @if(Auth::check())
                        @if(!empty(Auth::user()->avatar))
                            <img class="nav-user-avatar img-circle" src="{{ asset(Auth::user()->avatar) }} ">&nbsp;
                        @else
                            <img class="nav-user-avatar img-circle" src="{{ getDefaultUserAvatar() }} ">&nbsp;
                        @endif

                    @endif
                </a>
                <ul class="dropdown-menu" style="right: 18px" role="menu">
                    <li>

                        @if(!Auth::check())
                            <div class="auth">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3 class="bold text-center">My Account</h3>

                                        <div class="col-xs-12">
                                            <a href="{{ secure_url('/account/login') }}" class="link-btn">
                                                <button class="btn btn-info btn-block">
                                                    <i class="fa fa-sign-in"></i>&nbsp;Sign In
                                                </button>
                                            </a>

                                            <div class="strike m-t-10 m-b-10">
                                                <span>or</span>
                                            </div>
                                            <p>{!! link_to('/account/register', 'Create a PC-World Account', [], true) !!}</p>

                                            <p class="text-small">An account will allow you to view your orders, create
                                                wishlists, checkout fast, and much more</p>

                                            {!! link_to_route('myaccount', 'Account home', [], []) !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="auth">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <ul>
                                            <li>{!! link_to_route('myaccount', 'Account home', [], []) !!}</li>
                                            <li>{!! link_to_route('mycart', 'My shopping cart', [], []) !!}</li>
                                            <li>{!! link_to_route('myorders', 'My orders', [], []) !!}</li>
                                        </ul>

                                        <hr/>
                                        <a href="{{ route('logout') }}" class="link-btn">
                                            <button class="btn btn-success btn-block">
                                                <i class="fa fa-sign-out"></i>&nbsp;Sign out
                                            </button>
                                        </a>


                                    </div>
                                </div>
                            </div>
                        @endif

                    </li>
                </ul>
            </li>
        </ul>
        <div class="col-md-4 col-xs-12 col-sm-12 pull-right m-t-10 m-b-10">
            {!! Form::open(['route' => 'client.search', 'method' => 'get']) !!}
            <div class="input-group">
                {!! Form::text('q', null, ['class' => 'search-query form-control', 'placeholder' => 'search for a product...', 'id' => 'mainSearchForm']) !!}

                <div class="input-group-btn">
                    <button class="btn btn-default" onclick="return s();" type="submit"><i
                                class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            {!! Form::close() !!}
            <script>
                function s() {
                    var el = document.getElementById("mainSearchForm");
                    if (!el.value.trim()) {
                        el.focus();
                        return false;
                    }
                }
            </script>
        </div>

    </div>
    <!-- /.navbar-collapse -->
</nav>
@section('contact')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <p>Need help? contact support via the following numbers</p>
            <ul class="list-inline">
                <li class="bold">+254 705 568 254</li>
                <li class="bold">+254 799 568 233</li>
            </ul>
        </div>
    </div>
@stop
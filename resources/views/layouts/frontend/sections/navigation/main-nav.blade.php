<nav class="navbar navbar-inverse navbar-static-top yamm megamenu-horizontal" id="2cnd" role="navigation"
     style="z-index: auto">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#site-navigation-bar-main">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="site-navigation-bar-main">
        <ul class="custom-large-dropdown nav navbar-nav">
            <li class="active"><a href="#"><i class="icon fa fa-align-justify fa-fw"></i>&nbsp;<span class="bold">Products</span></a>
                <ul class="dropdown-menu">
                    @foreach($categories as $category)
                        <li class="p-all-10" style="font-size: 1.0em;">

                            <a href="{{ route('f.categories.view', ['id' => $category->id, 'name' => preetify($category->name)]) }}">
                                {{ beautify($category->name) }}
                            </a>
                            <ul class="dropdown-menu mega-menu">
                                <li class="container">
                                    <div class="row yamm-content" style="width: 768px">
                                        <div class="col-sm-12 col-md-3 p-all-10">
                                            <ul class="links list-unstyled" style="margin-left: 20px">
                                                @foreach($category->subcategories as $subcat)
                                                    <li style="border-bottom: 1px solid #E3E3E3">
                                                        <a href="{{ route('f.subcategories.view', ['id' => $subcat->id, 'name' => preetify($subcat->name)]) }}">
                                                            {{ beautify($subcat->name) }}
                                                        </a>
                                                    </li>
                                                    <br/>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="dropdown-banner-holder">
                                            {{--<a href="#"><img alt="" src="assets/images/banners/banner-side.png"></a>--}}
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- /.yamm-content -->
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        @include('layouts.frontend.sections.navigation.search')
        <div class="col-xs-12 col-md-5">
            <ul class="nav navbar-nav navbar-right user-account">
                @include('layouts.frontend.sections.navigation.wishlists')
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user nav-icon"></i>
                        {{ app\Models\User::displayStatus() }}
                    </a>
                    <ul class="dropdown-menu">
                        @include('layouts.frontend.sections.navigation.user-links')
                        <li class="divider"></li>
                        @if(Auth::check())
                            <li>
                                <a href="{{ route('logout') }}">
                                    <button class="btn btn-upper btn-danger btn-block m-t-5">
                                        <i class="fa fa-sign-out "></i> Log out
                                    </button>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}">
                                    <button class="btn btn-upper btn-primary btn-block m-t-10">
                                        <span class="fa fa-sign-in"></span> Sign In
                                    </button>
                                </a>
                            </li>
                            <li class="p-all-10">
                                <h6>New customer? please {!! link_to_route('register', 'create an account') !!}</h6>
                            </li>
                        @endif
                    </ul>
                </li>
                @include('layouts.frontend.sections.cart.cart-preview')
            </ul>
        </div>
    </div>
</nav>
<header>
    <nav class="navbar navbar-default navbar-static-top navbar-md very-top" id="1st">
        <div class="navbar-header col-md-2 col-xs-12">

            <a href="{{ route('home') }}">

                <h4 class="bold">PC WORLD</h4>

            </a>

            <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav top-links">
                <li><a href="#"><i class="fa fa-question"></i>&nbsp;Help</a></li>
                <li><a href="#"><i class="fa fa-plus"></i>&nbsp;Feedback</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right top-links-r">

                <li><a href="#"><i class="fa fa-info"></i>&nbsp;About PC-world</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-money"></i>&nbsp;Currency </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">KSH</a></li>
                        <li><a href="#">USD</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-flag"></i>&nbsp;Language </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">ENG</a></li>
                        <li><a href="#">FR</a></li>
                        <li><a href="#">GE</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-default navbar-static-top yamm megamenu-horizontal" id="2cnd" role="navigation" style="z-index: auto">
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
            <ul class="nav navbar-nav">
                <li><a href="#" class="active">Shop By category</a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('f.categories.view', ['id' => $category->id]) }}">
                                    {{ beautify($category->name) }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($category->subcategories as $subcategory)
                                        <li>
                                            <a href="{{ route('f.subcategories.view', ['id' => $subcategory->id]) }}">
                                                {{ beautify($subcategory->name) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        <li class="divider"></li>
                        <li><a href="#">Shop Top brands</a>
                            <ul class="dropdown-menu mega-menu">
                                <li class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <ul class="links list-unstyled">
                                                @foreach($brands as $brand)
                                                    <li style="padding: 10px">
                                                        <a href="{{ route('brands.shop', ['id' => $brand->id]) }}">
                                                            <img src="{{ $brand->logo }}" class="img-responsive">
                                                        </a>
                                                        <br/>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- /.yamm-content -->
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            @include('layouts.frontend.includes.search')
            <div class="col-xs-12 col-md-5">
                <ul class="nav navbar-nav navbar-right">
                    @include('layouts.frontend.includes.wishlists')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user nav-icon"></i>
                            {{ app\Models\User::displayStatus() }}
                        </a>
                        @if(Auth::check())
                            <ul class="dropdown-menu">
                                @include('layouts.frontend.includes.user-links')
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}">
                                        <button class="btn btn-upper btn-danger btn-block m-t-5">
                                            <i class="fa fa-sign-out "></i> Log out
                                        </button>
                                    </a>
                                </li>
                            </ul>
                        @else
                            <ul class="dropdown-menu">
                                @include('layouts.frontend.includes.user-links-default')
                            </ul>
                        @endif
                    </li>

                    @include('layouts.frontend.includes.cart-preview')

                </ul>
            </div>
        </div>
    </nav>
</header>

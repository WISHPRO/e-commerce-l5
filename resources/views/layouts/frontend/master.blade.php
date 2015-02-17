<!DOCTYPE html>
<html lang="en">
<head>
    @section('head')
        @include('layouts.frontend.includes.header')
    @show
</head>

<body>
<!-- site wrapper div -->
<div class="wrapper">

    <header class="header-style-custom">

        @section('top-navbar')

            @include('layouts.frontend.includes.top-navbar')

        @show

        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                        @section('sidebar')

                            @include('layouts.frontend.includes.side-nav-dropdown')

                        @show

                    </div>

                    @section('search')

                        <div class="col-xs-12 col-sm-12 col-md-9">
                            <div class="row pg-cont">
                                <div class="col-md-7 pull-left">
                                    {!! Form::open(['route' => 'client.search', 'method' => 'get']) !!}
                                    <div class="input-group">
                                        {!! Form::text('q', null, ['class' => 'search-query form-control', 'placeholder' => 'find a product by name, description or product #']) !!}

                                        <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit">
                                        <span class=" glyphicon glyphicon-search search-btn-header"></span>
                                    </button>
                                </span>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                                <div class="pull-right">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                        class="fa fa-heart"></i> Wishlist <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ Auth::check() ? route('mywishlist.create') : route('wishlist')}}">
                                                        <i class="fa fa-plus"></i> Create a wishlist
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="{{ Auth::check() ? route('mywishlist') : route('wishlist') }}">
                                                        <i class="fa fa-heart"></i> View my wishlists
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-user"></i> {{ Auth::check() ? beautify(Auth::user()->first_name) : "My Account" }}<b class="caret"></b>
                                            </a>
                                            @if(Auth::check())
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
                                                            <i class="fa fa-sign-out"></i> Log out
                                                        </button>

                                                    </a>
                                                </li>
                                            </ul>
                                                @else

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('login') }}">
                                                            <button class="btn btn-upper btn-primary btn-block m-t-10">
                                                                <i class="fa fa-sign-in"></i> Sign In
                                                            </button>

                                                        </a>
                                                    </li>
                                                    <li class="p-all-10">
                                                        <h6>New customer? please {!! link_to_route('register', 'create an account') !!}</h6>
                                                    </li>
                                                </ul>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div>

                    @show
                    <hr/>
                    @section('flash-messages')

                        @include('_partials.improved_alert')

                    @show

                    <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">
                        @section('slider')

                            @include('layouts.frontend.includes.main-slider')

                        @show
                    </div>

                    {{--@section('breadcrumb')--}}

                        {{--{{ Breadcrumbs::render() }}--}}

                    {{--@stop--}}

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->

        </div>

    </header>

    @section('content')

    @show

    <div class="container">
        @section('brands')

            @include('layouts.frontend.includes.brands')

        @show
    </div>

    @section('footer')

        @include('layouts.frontend.includes.footer')

    @show

</div>

<!-- end page wrapper -->
<!-- all javascript assets come here -->
@section('scripts')

    @include('layouts.frontend.includes.scripts')

@show
</body>

</html>
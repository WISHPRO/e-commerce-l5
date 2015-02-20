<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
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

            {{--@include('layouts.frontend.includes.top-navbar')--}}

        @show

        <div class="main-header">
            <div class="container">

                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="col-xs-4">
                            <a class="site-logo" href="#">
                                <img src="{{ asset('assets/images/logo.jpg') }}">
                            </a>
                        </div>

                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown active">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="bold">All categories</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    @foreach($categories = array_get($data, 'categories') as $category)
                                        <li class="dropdown-submenu">
                                            <a tabindex="-1" href="{{ route('f.categories.view', ['id' => $category->id]) }}">
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
                                    <li>
                                        {!! link_to_route('f.categories.display', 'View all Categories') !!}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @include('layouts.frontend.includes.search')
                        <div class="col-sm-6 col-md-4">
                            <ul class="nav navbar-nav navbar-right">
                                @if(shoppingCartExists())
                                    @include('layouts.frontend.includes.cart-preview')

                                @else
                                    @include('layouts.frontend.includes.empty_cart')

                                @endif

                                @include('layouts.frontend.includes.wishlists')
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-user nav-icon"></i>
                                        {{ displayUserStatus() }}
                                        <b class="caret"></b>
                                    </a>
                                    @if(Auth::check())
                                        @include('layouts.frontend.includes.user-links')
                                    @else

                                        @include('layouts.frontend.includes.user-links-default')
                                    @endif
                                </li>
                            </ul>
                        </div>

                    </div><!-- /.navbar-collapse -->
                </nav>

            </div>
            <!-- /.container -->

        </div>

    </header>

    <div class="container">
        <br/>
        <div class="row">
            @section('breadcrumbs')
                @include('layouts.frontend.includes.breadcrumbs')
            @show
        </div>
    </div>

    @section('slider')
        @include('layouts.frontend.includes.main-slider')
    @show

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
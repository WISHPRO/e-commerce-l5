<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <div class="pull-left">
                <a href="{{ route('home') }}">
                    {!! HTML::image('assets/images/logo.png', 'PC WORLD') !!}

                </a>

            </div>

        </div>
        <!-- /.header-top-inner -->
        @section('cart-preview')

            @include('layouts.frontend.includes.cart-preview')

        @show

    </div>
    <!-- /.container -->
</div>
@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>PC World&nbsp;&middot;&nbsp;Checkout</title>
@stop
@section('top-bar')
    @include('layouts.frontend.sections.navigation.top-navbar')
@show
@section('main-nav')

@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')

    <div class="container">
        <div class="row m-t-40">
            <div class="col-md-12">
                <div class="col-md-5 col-md-offset-1 login">
                    <h2>Returning customers</h2>

                    <p>Sign in to speed up the checkout process and save orders to your account.</p>
                    <hr/>
                    @include('_partials.forms.authentication.client_login', ['extra_class' => ''])
                </div>
                <div class="col-md-6 register">
                    <h2>New Customers</h2>
                    @if(config('site.checkout.allow_guest_checkout', true))
                        <p>Checkout as a guest. We will give you the opportunity to create an account at the end of the
                            checkout process</p>
                        <hr/>
                        <a href="{{ route('checkout.step1', ['allow' => true]) }}">
                            <button class="btn btn-primary btn-lg m-t-5"><i class="fa fa-arrow-right"></i>&nbsp;Checkout as
                                a guest
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@section('brands')

@stop
@section('footer')

    @include('layouts.frontend.sections.footer.footer-basic')
@stop
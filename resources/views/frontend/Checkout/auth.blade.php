@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>PC World&nbsp;&middot;&nbsp;Checkout</title>
@stop

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
                <div class="col-md-4 col-md-offset-2 login">
                    <h2>Returning customers</h2>

                    <p>Sign in to speed up the checkout process and save orders to your account.</p>
                    <hr/>
                    @include('_partials.forms.client_login', ['extra_class' => ''])
                </div>
                <div class="col-md-5 register">
                    <h2>New Customers</h2>

                    <p>Checkout as a guest. we will give you the opportunity to create an account at the end of the
                        checkout process</p>
                    <hr/>
                    <a href="{{ route('checkout.step1', ['guest' => true]) }}">
                        <button class="btn btn-primary btn-lg m-t-20"><i class="fa fa-arrow-right"></i>&nbsp;Checkout as
                            a guest
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')

@stop
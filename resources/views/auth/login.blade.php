@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Login &middot; Register</title>
@stop

@section('breadcrumbs')
@stop

@section('slider')
@stop

@section('content')
    <div class="container-fluid">
        <div class="row authentication">
            <div class="col-md-4 col-md-offset-2 login">
                <h1>Please Sign In</h1>
                <hr/>
                @include('_partials.client_login', ['extra_class' => ''])
            </div>
            <div class="col-md-4 register">
                <h1>Or, Register for <span class="text-success">FREE</span></h1>
                <hr/>
                <h4>Registration will allow you to;</h4>
                <ul class="list-unstyled registration-pros">
                    <li><span class="fa fa-check text-success"></span> See all your orders</li>
                    <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                    <li><span class="fa fa-check text-success"></span> Create wishlists</li>
                    <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                    <li><span class="fa fa-check text-success"></span> Get a gift
                        <small>(only new customers)</small>
                    </li>
                </ul>
                <br/>

                <p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg btn-block">Yes please, register
                        now!</a>
                </p>
            </div>
        </div>
    </div>
@stop

@section('brands')
@stop
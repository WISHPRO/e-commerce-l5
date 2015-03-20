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
            <div class="col-md-4 col-md-offset-2">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#login" aria-controls="home" role="tab" data-toggle="tab">
                            <h4>
                                Login
                            </h4>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#register" aria-controls="profile" role="tab" data-toggle="tab">
                            <h4>Register</h4>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="login">
                        <div class="m-t-20">
                            @include('_partials.forms.client_login', ['extra_class' => ''])
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="register">

                        <hr/>
                        <h4>Registration will allow you to;</h4>
                        <ul class="list-unstyled registration-pros m-b-30">
                            <li><span class="fa fa-check text-success"></span> See all your orders</li>
                            <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                            <li><span class="fa fa-check text-success"></span> Create wishlists</li>
                            <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                            <li><span class="fa fa-check text-success"></span> Get a gift
                                <small>(only new customers)</small>
                            </li>
                        </ul>

                        <p>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-block">Yes please, register
                                now!</a>
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('brands')
@stop
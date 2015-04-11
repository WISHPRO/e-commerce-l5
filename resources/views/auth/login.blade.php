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
                    <div role="tabpanel" class="tab-pane active wow fadeInUp animated" id="login">
                        <div class="m-t-20">
                            @include('_partials.forms.authentication.client_login', ['heading' => true, 'extra_class' => ''])
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane wow fadeInUp animated" id="register">

                        @include('_partials.forms.authentication.client_registration')


                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('brands')
@stop
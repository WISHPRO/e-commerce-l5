@extends('layouts.shared.auth')

@section('header')
    @parent
    <title>Backend Login</title>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 login">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Backend Login</h3>

                    <div class="password-helper">
                        <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">Forgot password?</a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row wow bounce">
                        @if(Session::has('flash_notification.message') || $errors->has())
                            <div id="login-alert"
                                 class="alert alert-{{ Session::get('flash_notification.level') === null ? 'danger' : Session::get('flash_notification.level') }} col-sm-12">
                                <ul>
                                    {{ Session::get('flash_notification.message') }}
                                    @foreach ($errors->all() as $message)
                                        <li>
                                            {{ $message }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div id="login-form-ajax-result"></div>
                    </div>
                    {!! Form::open(['route' => 'backend.login.post', 'id' => 'loginForm', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    <div class="form-group">
                        <div class="input-group authentication">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your email address', 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group authentication">
                            <span class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </span>
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter your password', 'required']) !!}
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="checkbox rm">
                            {!! Form::checkbox('remember', 'remember', null, false, []) !!} Remember me
                        </div>
                    </div>

                    <div class="form-group adm-login">
                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Log In</button>
                            <span class="alt-ajax-image"><img src="{{ alt_ajax_image() }}"> </span>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @include('_partials.modals.help.forgotPassword', ['elementID' => 'forgotPasswordModal'])
@stop
@extends('layouts.shared.auth')

@section('header')
    @parent
    <title>Backend Login</title>
@stop

@section('content')
    <style>
        html {
            height: 100%;
            width: 100%;
        }

        body {
            background-color: #3b3d39;
        }

        .password-helper {
            float: right;
            font-size: 80%;
            position: relative;
            top: -10px
        }

        .panel-body {
            padding-top: 30px;
            margin: 0 10px 0 10px;
        }

        .adm-login {
            margin-top: 10px
        }

        .input-group > .rm {
            margin-left: 20px;
        }

        .disabled {
            cursor: not-allowed;
            color: #fff;
        }

        .error-msg {
            color: #f04124;
            font-weight: 700;

        }

        .login {
            top: 100px;
        }
    </style>
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
                    <div class="row">
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
                    </div>
                    {!! Form::open(['route' => 'backend.login.post', 'id' => 'loginForm', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    <div class="form-group">
                        <div class="input-group authentication">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your email address', 'required']) !!}
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
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @include('_partials.modals.help.forgotPassword', ['elementID' => 'forgotPasswordModal'])
@stop
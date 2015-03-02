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
                <form role="form" method="POST" action="{{ route('login.verify') }}" id="loginForm">
                    {!! generateCSRF() !!}
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="Enter your email address" required>
                        @if($errors->has('email'))
                            <span class="error-msg">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Enter your password" required>
                        @if($errors->has('password'))
                            <span class="error-msg">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="{{ route('password.reset') }}">I forgot my password
                                </a>
                            </label>
                        </div>

                    </div>
                    <br/>
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in"></i>&nbsp;Sign in</button>
                    <hr/>
                    @if(Request::isSecure())
                        <span class="text text-info hidden-xs">
                                <a href="#" id="help" data-toggle="popover" data-trigger="focus"
                                   title="Security"
                                   data-content="We use high grade SSL(secure sockets layer) encryption to protect your personal information against loss, misuse and alteration
                                   Always lookout for a green padlock in the URL bar of your browser. It implies that your information in transit is secured through SSL">
                                    <i class="fa fa-lock sec-info"></i> Security guaranteed
                                </a>
                            </span>
                    @endif
                </form>
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
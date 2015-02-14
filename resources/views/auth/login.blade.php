@extends('layouts.shared.auth')

@section('content')

<div class="container-fluid">
    <div class="row auth-form">
        <div class="ref-logo">
            <a href="{{ route('home') }}">
                <div>
                    {!! HTML::image('assets/images/logo.png', 'PC WORLD') !!}
                </div>
            </a>
        </div>
        <div class="row session-info">
            @if(Session::has('message') || Session::has('alertclass') || $errors->has())
                <div id="login-alert"
                     class="alert {{ Session::get('alertclass') === null ? 'alert-danger' : Session::get('alertclass')}} col-sm-12">
                    <ul>
                        {{ Session::get('message') === null ? "Whops!. There were some problems with your input" : Session::get('message') }}
                        <br/>
                        <br/>
                        @foreach ($errors->all() as $message)
                            <li>
                                {{ $message }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-12 auth-container">
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Please Sign In</h2>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ route('login.verify') }}" id="loginForm">
                            {!! generateCSRF() !!}
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:
                                    <a href="{{ route('password.reset') }}">(forgot password)
                                    </a>
                                </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                 <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                 </div>

                            </div>
                            <button type="submit" class="btn btn-success btn-lg">Sign in</button>
                            <hr/>
                            @if(Request::isSecure())
                            <span class="text text-info">
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
                </div>
                <div class="modal fade" id="viewHelpContent" tabindex="-1" role="dialog"
                     aria-labelledby="view"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <p>
                            </p>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <div class="col-md-5">

                    <p class="lead">Register today for <span class="text-success">FREE</span></p>
                    <h6>Registration will allow you to;</h6>
                    <ul class="list-unstyled" style="line-height: 2">
                        <li><span class="fa fa-check text-success"></span> See all your orders</li>
                        <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                        <li><span class="fa fa-check text-success"></span> Create wishlists</li>
                        <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                        <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
                    </ul>
                    <p>
                        <a href="{{ route('register') }}" class="btn btn-info btn-block">Yes please, register now!</a>
                    </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="copyright">
            <p class="text-center">&copy; PC-World, {{ date('Y') }}</p>
        </div>

    </div>
</div>
@stop
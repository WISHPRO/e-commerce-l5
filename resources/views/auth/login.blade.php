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
        <div class="col-md-12 auth-container">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title"><strong>Please Sign In </strong></h2>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ route('login.verify') }}" id="loginForm">
                            {!! generateCSRF() !!}
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:
                                    <a href="{{ route('password.reset') }}">(forgot password)
                                    </a>
                                </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
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
                            <span class="text">
                                <a href="#" id="help" data-toggle="modal" data-target="#viewHelpContent">
                                    <i class="fa fa-lock"></i> ssl secured
                                </a>
                            </span>
                            @endif
                            <div class="modal fade" id="viewHelpContent" tabindex="-1" role="dialog"
                                 aria-labelledby="view"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <p>Always lookout for a green padlock in the url bar of your browser. It indicates that the connection between
                                            your computer/mobile phone and the server on our side is encrypted, using SSL(secure sockets layer)
                                        </p>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </form>
                    </div>
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
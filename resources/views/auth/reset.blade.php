@extends('layouts.frontend.master')

@section('head')
    @parent
    {!! HTML::style('assets/css/vendor/formvalidation/formValidation.min.css') !!}
    <title>Reset Account password</title>
@stop

@section('breadcrumbs')
@stop

@section('slider')
@stop


@section('content')

    <div class="container-fluid">
        <div class="row authentication">
            @if(!\Session::pull('errorFatal'))
                <div class="col-md-4 col-md-offset-2">
                    <h3>Reset your password here: </h3>

                    <p>You will be automatically signed in, once you finish</p>
                    <hr/>
                    <form role="form" method="POST" action="{{ route('reset.finish') }}" id="resetForm">
                        {!! generateCSRF() !!}
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="Enter your email address" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <span class="error-msg">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">New password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Enter your new password" required>
                            @if($errors->has('password'))
                                <span class="error-msg">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repeat new password:</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation" placeholder="Repeat your new password" required>
                            @if($errors->has('password_confirmation'))
                                <span class="error-msg">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-success btn-lg btn-block">Save new password</button>
                    </form>
                </div>
            @else
                <div class="col-md-4 col-md-offset-2 col-sm-8 col-xs-12 alert alert-danger">
                    <p class="bold">An error occured. The password reset token either expired, or is invalid</p>

                    <p>Just request for a new one using the link below</p>
                    <br/>
                    {!! link_to_route('password.reset', 'Reset password') !!}
                </div>
            @endif
        </div>
    </div>
@stop

@section('brands')
@stop

@section('scripts')
    @parent
    {!! HTML::script('assets/js/vendor/formvalidation/formValidation.min.js') !!}
    {!! HTML::script('_bootstrap.min.js') !!}
    {!! HTML::script('assets/js/validation.js') !!}
@stop
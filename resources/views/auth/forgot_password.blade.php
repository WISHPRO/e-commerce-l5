@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Forgot password</title>
@stop

@section('main-nav')

@stop
@section('breadcrumbs')
@stop

@section('slider')
@stop

@section('content')

    <div class="container-fluid">
        <div class="row authentication wow fadeInUp animated">
            @if(is_null(session('status')))
                <div class="col-md-4 col-md-offset-2 col-sm-8 col-xs-12">
                    <p>Forgot your account's password? </p>
                </div>
            @else
                <div class="col-md-4 col-md-offset-2 col-sm-8 col-xs-12 alert alert-success">
                    <p class="bold">Account recovery email sent successfully to {{ Session::pull('email_address') }}</p>
                    <br/>

                    <p>
                        If you don't see this email in your inbox within 15 minutes, look for it in your junk mail
                        folder.
                        If you find it there, please mark it as "Not Junk".
                    </p>
                    <br/>
                    <a href="{{ route('home') }}">
                        <button class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp; Back to home page
                        </button>
                    </a>
                </div>
            @endif
        </div>
    </div>
@stop
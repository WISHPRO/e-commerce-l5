@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Reset Account password</title>
@stop

@section('breadcrumbs')
@stop

@section('slider')
@stop


@section('content')

    <div class="container-fluid">
        <div class="row authentication  animated">
            @if(!\Session::pull('errorFatal'))
                @include('_partials.forms.help.password_reset')
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
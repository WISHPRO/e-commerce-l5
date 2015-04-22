@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Registration</title>
@stop

@section('slider')
@stop

@section('content')
    <div class="container-fluid">
        <div class="row authentication ">
            <div class="auth-container">
                <div class="col-md-5 col-md-offset-1">
                    <h5>Take a few minutes to create an account now. Your information will safely be secured with us to
                        save you time, next time.</h5>
                    <hr/>
                    @include('_partials.forms.authentication.client_registration')
                </div>

            </div>
        </div>
    </div>
@endsection
@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Registration</title>
@stop

@section('breadcrumbs')
@stop

@section('slider')
@stop

@section('content')
    <div class="container-fluid">
        <div class="row authentication wow fadeInUp animated">
            <div class="auth-container">
                <p class="text-muted text-center">Take a few minutes to create an account now. Your information will
                    safely be secured with us to save you time, next time.</p>
                <br/>

                <p class="text text-info text-center">*All fields are required</p>
                <hr/>
                @include('_partials.forms.authentication.client_registration')
            </div>
        </div>
    </div>
@endsection
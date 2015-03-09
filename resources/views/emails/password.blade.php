@extends('layouts.shared.email)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h2>Hello, {{ $user->getUserName() }}</h2>

                <p>At {{ Carbon\Carbon::now() }}, you requested for a link to reset your password. Click the button
                    below to
                    proceed</p>
                <br/>
                <a href="{{ route('reset.start', ['token' => $token])  }}">
                    <button class="btn btn-success btn-lg center-block">
                        <i class="fa fa-user"></i> <b>Reset password</b>
                    </button>

                </a>
                <br/>

                <p><b>Note: This reset link expires in {{ floor(config('auth.password.expire') / 60) }} hour(s)</b>. If
                    you did not request this email, just ignore it. Your
                    password would not be changed until
                    you access the link above to create a new one</p>
            </div>

        </div>

    </div>
@stop
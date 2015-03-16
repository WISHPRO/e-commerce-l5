<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<meta charset="UTF-8">
{!! HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css')!!}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
{!! HTML::script('//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') !!}
{!! HTML::script('//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') !!}
<![endif]-->
<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
{!! HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css')!!}
<!-- site Icon -->

<style>
    a:link, a:visited, a:hover, a:active {
        text-decoration: none;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <h2>Hello, {{ $user->getUserName() }}</h2>

            <p>
                At {{ Carbon\Carbon::now() }}, you requested for a link to reset your password. Click the button
                below to
                reset your account password
            </p>
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

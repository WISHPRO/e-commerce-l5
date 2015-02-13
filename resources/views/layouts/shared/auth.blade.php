<!DOCTYPE html>
<html>
@section('head')
<head lang="en">
    <meta charset="UTF-8">
    <title>Authentication</title>
    {!! HTML::style('assets/css/vendor/bootstrap/bootstrap.min.css')!!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {!! HTML::script('//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') !!}
    {!! HTML::script('//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') !!}
    <![endif]-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    {!! HTML::style('assets/css/vendor/font-awesome.min.css')!!}
    <!-- site Icon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    {!! HTML::style('assets/css/vendor/formvalidation/formValidation.min.css') !!}
    {!! HTML::style('assets/css/auth.css')!!}
</head>

@show
<body>
    <div class="container-fluid">
        @section('content')

        @show
    </div>
</body>
@section('scripts')
    {!! HTML::script("assets/js/vendor/jquery/jquery-2.1.3.min.js") !!}
    {!! HTML::script('assets/js/vendor/formvalidation/formValidation.min.js') !!}
    {!! HTML::script('assets/js/vendor/formvalidation/framework/bootstrap.min.js') !!}
    {!! HTML::script('assets/js/validation.js') !!}
@show
</html>
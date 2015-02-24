<!DOCTYPE html>
<html>
@section('head')
    <head lang="en">
        <meta charset="UTF-8">
        <title>Authentication</title>
	    {!! HTML::style('css/libs.css') !!}
	    {!! HTML::style('css/shared.css') !!}
	    {!! HTML::style('css/o/auth.css') !!}
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        {!! HTML::script('//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') !!}
        {!! HTML::script('//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') !!}
        <![endif]-->
        <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <!-- site Icon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
	    {!! HTML::script('js/shared.js') !!}
    </head>

@show
<body>
<div class="container-fluid">
    @section('notificatiions')
        @include('_partials.improved_alert')
    @stop

    @section('content')

    @show
</div>
</body>
@section('scripts')
    {!! HTML::script("js/libs.js") !!}
    {!! HTML::script("js/main.js") !!}
@show
</html>
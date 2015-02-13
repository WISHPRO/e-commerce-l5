<!DOCTYPE html>
<html>

<head lang="en">
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
</head>


<body>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-4">
            <h3>Hey, You requested to reset your account password, at {{ Carbon\Carbon::now('Africa/Nairobi') }}</h3>
            <p>Click the button below to get started:</p>

            <a href="{{ route('reset.start', ['token' => $token])  }}">
                <button class="btn btn-primary">
                    <i class="fa fa-user"></i> Reset password
                </button>

            </a>
        </div>

    </div>

</div>
</body>

{!! HTML::script("//code.jquery.com/jquery-1.11.2.min.js") !!}

</html>
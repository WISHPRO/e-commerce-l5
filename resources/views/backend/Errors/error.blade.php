<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $code }} :(</title>
    <style>
        ::-moz-selection {
            background: #b3d4fc;
            text-shadow: none;
        }

        ::selection {
            background: #b3d4fc;
            text-shadow: none;
        }

        html {
            padding: 30px 10px;
            font-size: 20px;
            line-height: 1.4;
            color: #737373;
            background: #f0f0f0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        html,
        input {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        body {
            max-width: 500px;
            _width: 500px;
            padding: 30px 20px 50px;
            border: 1px solid #b3b3b3;
            border-radius: 4px;
            margin: 0 auto;
            box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff;
            background: #fcfcfc;
        }

        h1 {
            margin: 0 10px;
            font-size: 50px;
            text-align: center;
        }

        h1 span {
            color: #bbb;
        }

        h3 {
            margin: 1.5em 0 0.5em;
        }

        p {
            margin: 1em 0;
        }

        ul {
            padding: 0 0 0 40px;
            margin: 1em 0;
        }

        .container {
            max-width: 380px;
            _width: 380px;
            margin: 0 auto;
        }

        input::-moz-focus-inner {
            padding: 0;
            border: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>{{ $code }} <span>:(</span></h1>

    @if($code === '404')
        <p>{{ $message }}</p>
        <p>Sorry, but the page you were trying to view does not exist.</p>

        <p>It looks like this was the result of either:</p>
        <ul>
            <li>a mistyped address</li>
            <li>an out-of-date link</li>
        </ul>
        <hr/>
    @elseif($code === '500')
        <p>{{ $message }}</p>
        <p>For administrators, please quckly review this in the {{ link_to_route('system.logs', 'logs section') }}</p>
    @else
        <p>{{ $message }}</p>
    @endif

    <p>Your only solution is to {{ link_to_route('home', 'go back home') }}</p>
</div>
</body>
</html>

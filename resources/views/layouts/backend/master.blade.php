<!DOCTYPE html>
<html lang="en">
<head>
    @section('header')
        @include('layouts.backend.includes.header')
    @show
</head>
<body>
<div id="wrapper">
    @section('navigation')
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            @include('layouts.backend.includes.top_navbar')

            @include('layouts.backend.includes.sidebar')
        </nav>
    @show
    <div id="page-wrapper">
        @section('flash-messages')
            @include('_partials.improved_alert')
        @show

        @section('content')

            @show
                    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
@section('scripts')
    @include('layouts.backend.includes.scripts')
@show
</body>
</html>

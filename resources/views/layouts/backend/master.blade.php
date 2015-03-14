<!DOCTYPE html>
<html lang="en">
<head>
    @section('header')
        @include('layouts.backend.sections.header')
    @show
</head>
<body>
<div id="wrapper">
    @section('navigation')

        @include('layouts.backend.sections.top_navbar')

    @show
    <div id="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    @include('flash::message')
                    <br/>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 10px; margin-bottom: 100px">
            @section('content')

            @show
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
@section('scripts')
    @include('layouts.backend.sections.scripts')
    <script>
        $("[data-toggle='tooltip']").tooltip();

        $('[data-toggle="popover"]').popover();
        $('#flash-overlay-modal').modal();
    </script>
@show
</body>
</html>

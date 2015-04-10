<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    @section('head')
        @include('layouts.frontend.sections.navigation.header')
    @show
</head>

<body>
{{--@include('layouts.Shared.olark')--}}
<div id="wrapper">
    <header>
        @section('top-bar')
            @include('layouts.frontend.sections.navigation.top-navbar')
        @stop
        @section('main-nav')
            @include('layouts.frontend.sections.navigation.main-nav')
        @show

    </header>
    @include('_partials.no-javascript')
    <div class="container">
        @section('breadcrumbs')

        @show

        @section('notification')

            @include('flash::message')

        @show
    </div>

    <div class="row">
        @section('slider')

            @include('layouts.frontend.sections.slider.main-slider', ['size' => 12])

        @show
    </div>

    <div id="ajax-image"></div>

    @section('content')

    @show

    @section('brands')

        @include('layouts.frontend.sections.footer.brands')

    @show
    @section('footer')

        @include('layouts.frontend.sections.footer.footer')

    @show
</div>

<!-- all javascript assets come here -->
@section('scripts')
    {!! HTML::script('js/frontend/libs.js') !!}
    {!! HTML::script('js/frontend/main.js') !!}
@show
<script>
    $('#flash-overlay-modal').modal();
</script>

</body>

</html>
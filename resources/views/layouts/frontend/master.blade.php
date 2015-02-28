<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
	@section('head')
		@include('layouts.frontend.includes.header')
	@show
</head>

<body>

<div class="wrapper">
	@include('layouts.frontend.includes.navigation')

	<div class="container">
		@section('breadcrumbs')
			@include('layouts.frontend.includes.breadcrumbs')
		@show

		@section('notification')

                @include('flash::message')

		@show
	</div>

	@section('slider')

		@include('layouts.frontend.includes.main-slider')

	@show

	@section('content')

	@show

	@section('footer')

		@include('layouts.frontend.includes.footer')

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
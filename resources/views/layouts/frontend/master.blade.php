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

			@include('_partials.improved_alert')

		@show
	</div>

	@section('slider')

		@include('layouts.frontend.includes.main-slider')

	@show

	@section('content')

	@show

	@section('brands')
		<div class="container">
			@include('layouts.frontend.includes.brands')
		</div>
	@show


	@section('footer')

		@include('layouts.frontend.includes.footer')

	@show
</div>

<!-- all javascript assets come here -->
@section('scripts')

	@include('layouts.frontend.includes.scripts')

@show
</body>

</html>
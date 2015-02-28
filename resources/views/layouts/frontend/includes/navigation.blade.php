<header>
	<div class="navbar navbar-default navbar-static-top navbar-md very-top" id="1st">
		<div class="navbar-header">
			<div class="col-xs-4">
				<a class="site-logo" href="{{ route('home') }}">
					<img src="{{ asset('assets/images/logo.jpg') }}">
				</a>
			</div>
			<a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav top-links">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">More</a></li>
				<li><a href="#">Help</a></li>
				<li><a href="#">Options</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right top-links-r">
				<li><a href="#">Feedback</a> </li>
				<li><a href="#">About PC-world</a> </li>
				<li><a href="#">Currency</a> </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">English</a></li>
                        <li><a href="#">French</a></li>
                        <li><a href="#">German</a></li>
                    </ul>
                </li>
			</ul>
		</div>
	</div>
	<nav class="navbar navbar-default navbar-static-top" id="2cnd" role="navigation" style="margin-top: -20px">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
			        data-target="#site-navigation-bar-main">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="site-navigation-bar-main">
			<ul class="nav navbar-nav">
				<li class="dropdown active">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="bold">Shop By category</span>
						<b class="caret"></b></a>
					<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
						@foreach($categories as $category)
							<li class="dropdown-submenu">
								<a tabindex="-1"
								   href="{{ route('f.categories.view', ['id' => $category->id]) }}">
									{{ beautify($category->name) }}
								</a>
								<ul class="dropdown-menu">
									@foreach($category->subcategories as $subcategory)
										<li>
											<a href="{{ route('f.subcategories.view', ['id' => $subcategory->id]) }}">
												{{ beautify($subcategory->name) }}
											</a>
										</li>
										<li class="divider"></li>
									@endforeach
								</ul>
							</li>
							<li class="divider"></li>
						@endforeach
						<li>
							{!! link_to_route('f.categories.display', 'View all Categories') !!}
						</li>
					</ul>
				</li>
			</ul>
			@include('layouts.frontend.includes.search')
			<div class="col-xs-12 col-md-4">
				<ul class="nav navbar-nav navbar-right">
					@include('layouts.frontend.includes.wishlists')
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user nav-icon"></i>
								{{ app\Models\User::displayStatus() }}
							<b class="caret"></b>
						</a>
						@if(Auth::check())
							<ul class="dropdown-menu">
								@include('layouts.frontend.includes.user-links')
								<li class="divider"></li>
								<li>
									<a href="{{ route('logout') }}">
										<button class="btn btn-upper btn-danger btn-block m-t-5">
											<i class="fa fa-sign-out "></i> Log out
										</button>
									</a>
								</li>
							</ul>
						@else
							<ul class="dropdown-menu">
								@include('layouts.frontend.includes.user-links-default')
							</ul>
						@endif
					</li>

					@include('layouts.frontend.includes.cart-preview')

				</ul>
			</div>
		</div>
	</nav>
</header>

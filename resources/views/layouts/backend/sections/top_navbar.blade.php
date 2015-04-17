<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('backend') }}">PC World (backend)</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="dropdown {{ (Request::segment(2) == 'counties') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-hover="dropdown"><i class="fa fa-map-marker"></i>&nbsp;Counties
                    <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('backend.counties.index') }}"><i class="fa fa-eye"></i>&nbsp;View all counties</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#createCounty">
                            <i class="fa fa-plus"></i>
                            &nbsp;Add a county
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.statistics.county') }}"><i class="fa fa-bar-chart"></i>&nbsp;County
                            statistics </a></li>
                </ul>
            </li>
            <li class="dropdown {{ (Request::segment(2) == 'users') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-hover="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;Users<span
                            class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('backend.users.index') }}"><i class="fa fa-eye"></i>&nbsp;View All users</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.users.create') }}"><i class="fa fa-user-plus"></i>&nbsp;Add user</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ action('Backend\UserRolesController@index') }}"><i class="fa fa-user-secret"></i>&nbsp;Users
                            & roles</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.statistics.users') }}"><i class="fa fa-bar-chart"></i>&nbsp;User
                            statistics</a></li>
                </ul>
            </li>
            <li class="dropdown {{ (Request::segment(2) == 'products') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-hover="dropdown"><i
                            class="fa fa-desktop"></i>&nbsp;Inventory<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('backend.products.create') }}">
                            <i class="fa fa-plus"></i>&nbsp;Add a new product
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('backend.products.index') }}">
                            <i class="fa fa-eye"></i>&nbsp;View All products
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('backend.brands.index') }}">
                            <i class="fa fa-apple"></i>&nbsp; Product Brands
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('backend.categories.index') }}">
                            <i class="glyphicon glyphicon-arrow-right"></i>
                            Product Categories
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('backend.subcategories.index') }}">
                            <i class="glyphicon glyphicon-arrow-right"></i> Product Sub-categories
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('backend.statistics.inventory') }}">
                            <i class="fa fa-bar-chart"></i>&nbsp;Inventory statistics
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ (Request::segment(2) == 'advertisements') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-hover="dropdown"><i class="fa fa-bullhorn"></i>&nbsp;Site
                    Advertisements<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('backend.ads.index') }}"><i class="fa fa-eye"></i>&nbsp;All advertisements</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.ads.create') }}"><i class="fa fa-plus"></i>&nbsp;Create advert</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="fa fa-bar-chart"></i>&nbsp;Advertisement statistics</a></li>
                </ul>
            </li>
            <li class="dropdown  {{ (Request::segment(2) == 'security') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-hover="dropdown" role="button" aria-expanded="false">
                    <i class="fa fa-user-secret"></i>&nbsp;System Security <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ action('Backend\RolesController@index') }}">
                            <i class="fa fa-eye"></i>&nbsp;View System Roles
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ action('Backend\PermissionsController@index') }}">
                            <i class="glyphicon glyphicon-lock"></i> Role permissions
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ action('Backend\UserRolesController@create') }}"><i class="fa fa-users"></i>&nbsp;Assign
                            Roles</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ action('Backend\UserRolesController@index') }}">
                            <i class="fa fa-user-secret"></i>&nbsp;Users and Roles
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('backend.statistics.security') }}">
                            <i class="fa fa-bar-chart"></i>&nbsp;Security statistics
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ (Request::segment(2) == 'statistics') ? 'active' : ''}}">
                <a href="{{ route('backend.statistics') }}"><i class="fa fa-fw fa-bar-chart-o"></i> System
                    Statistics</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right: 5px;">
            <li class="dropdown  {{ (Request::segment(2) == 'myaccount') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-hover="dropdown">
                    {{ $auth_user->getUserName() }}
                    <b class="caret"></b>
                    @if($is_logged_in)
                        @if(!empty($auth_user->avatar))
                            <img class="nav-user-avatar img-circle" src="{{ asset($auth_user->avatar) }} ">&nbsp;
                        @else
                            <img class="nav-user-avatar img-circle" src="{{ default_user_avatar() }} ">&nbsp;
                        @endif

                    @endif
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('backend.myaccount') }}"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('backend.logout') }}"><i class="fa fa-fw fa-sign-out"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    @include('_partials.modals.county.addCounty', ['elementID' => 'createCounty'])
</nav>
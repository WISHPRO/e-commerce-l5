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
        <li class="{{ (Request::segment(2) == 'charts') ? 'active' : ''}}" style="border-left: 1px solid #606060">
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> Statistics</a>
        </li>
        <li class="dropdown {{ (Request::segment(2) == 'counties') ? 'active' : '' }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-map-marker"></i>&nbsp;Counties <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('backend.counties.index') }}"><i class="fa fa-eye"></i>&nbsp;View all counties</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('backend.counties.create') }}"><i class="fa fa-plus"></i>&nbsp;Add a county</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-bar-chart"></i>&nbsp;County statistics </a></li>
            </ul>
        </li>
        <li class="dropdown {{ (Request::segment(2) == 'users') ? 'active' : '' }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i>&nbsp;Users<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('backend.users.index') }}"><i class="fa fa-eye"></i>&nbsp;View All users</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('backend.users.create') }}"><i class="fa fa-user-plus"></i>&nbsp;Add user</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-user-secret"></i>&nbsp;User roles</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-bar-chart"></i>&nbsp;User statistics</a></li>
            </ul>
        </li>
        <li class="dropdown {{ (Request::segment(2) == 'products') ? 'active' : '' }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-desktop"></i>&nbsp;Inventory<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('backend.products.index') }}">All products</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('backend.brands.index') }}">Product Brands</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('backend.categories.index') }}">Product Categories</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('backend.subcategories.index') }}">Product Sub-categories</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-bar-chart"></i>&nbsp;Inventory statistics</a> </li>
            </ul>
        </li>
        <li class="dropdown  {{ (Request::segment(2) == 'security') ? 'active' : '' }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fa fa-user-secret"></i>&nbsp;System Security <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ action('Backend\RolesController@index') }}">
                        User Roles
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ action('Backend\UserRolesController@create') }}">Assign Roles</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        Revoke Roles
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="margin-right: 5px;">
        <li class="dropdown  {{ (Request::segment(2) == 'myaccount') ? 'active' : '' }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i>&nbsp;{{ Auth::user()->getUserName() }}
                <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('backend.myaccount.index') }}"><i class="fa fa-fw fa-user"></i> Profile</a>
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
                    <a href="{{ route('backend.logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
</nav>
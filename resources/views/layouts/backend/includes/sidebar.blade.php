<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class={{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}>
            <a href="#"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li class={{ (Request::segment(2) == 'charts') ? 'active' : ''}}>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> Statistical Charts</a>
        </li>
        <li class={{ (Request::segment(3) == 'counties') ? 'active' : ''}}>
            <a href="{{ route('counties.view') }}"><i class="fa fa-location-arrow"></i> Counties</a>
        </li>
        <li>
            <a href="#" data-toggle="collapse" data-target="#security"><i class="fa fa-warning"></i>
                System Security <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="security" class="collapse">
                <li class={{ (Request::segment(3) == 'roles') ? 'active' : '' }}>
                    <a href="{{ route('roles.view') }}">
                        <i class="fa fa-fw fa-users"></i> Roles
                    </a>
                </li>
                <li class={{ (Request::segment(3) == 'roles') ? 'active' : '' }}>
                    <a href="{{ route('roles.revoke') }}">
                        <i class="fa fa-fw fa-remove"></i> Revoke Roles from user
                    </a>
                </li>
                <li class={{ (Request::segment(4) == 'permissions') ? 'active' : '' }}>
                    <a href="{{ route('permissions.view') }}">
                        <i class="fa fa-lock"></i> All Permissions
                    </a>
                </li>
                <li class={{ (Request::segment(4) == 'permissions') ? 'active' : '' }}>
                    <a href="{{ route('roles.permissions.get') }}">
                        <i class="fa fa-lock"></i> Assign permissions to roles
                    </a>
                </li>
                <li class={{ (Request::segment(4) == 'assign') ? 'active' : '' }}>
                    <a href="{{ route('roles.assign') }}"><i class="fa fa-users"></i> Assign roles to users</a>
                </li>
            </ul>
        </li>
        <li class={{ (Request::segment(3) == 'users') ? 'active' : '' }}>
            <a href="{{ route('users.view') }}"><i class="fa fa-fw fa-user"></i> Users</a>
        </li>
        <li class={{ (Request::segment(3) == 'products') ? 'active' : '' }}>
            <a href="{{ route('products.view') }}"><i class="fa fa-fw fa-desktop"></i> Products</a>
        </li>
        <li class={{ (Request::segment(3) == 'brands') ? 'active' : '' }}>
            <a href="{{ route('brands.view') }}"> Product brands</a>
        </li>
        <li class={{ (Request::segment(3) == 'categories') ? 'active' : '' }}>
            <a href="{{ route('categories.view') }}"><i class="fa fa-fw fa-info"></i> Categories</a>
        </li>
        <li class={{ (Request::segment(3) == 'subcategories') ? 'active' : '' }}>
            <a href="{{ route('subcategories.view') }}">
                <i class="fa fa-fw fa-forward"></i> Sub-Categories
            </a>
        </li>
    </ul>
</div>
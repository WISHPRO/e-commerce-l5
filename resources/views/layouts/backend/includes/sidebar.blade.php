<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class={{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}>
            <a href="#"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li class={{ (Request::segment(2) == 'charts') ? 'active' : ''}}>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> Statistical Charts</a>
        </li>
        <li class={{ (Request::segment(3) == 'counties') ? 'active' : ''}}>
            <a href="{{ action('Backend\CountiesController@index') }}"><i class="fa fa-location-arrow"></i> Counties</a>
        </li>
        <li>
            <a href="#" data-toggle="collapse" data-target="#security"><i class="fa fa-warning"></i>
                System Security <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="security" class="collapse">
                <li class={{ (Request::segment(3) == 'roles') ? 'active' : '' }}>
                    <a href="{{ action('Backend\RolesController@index') }}">
                        <i class="fa fa-fw fa-users"></i> Roles
                    </a>
                </li>
                <li class={{ (Request::segment(4) == 'assign') ? 'active' : '' }}>
                    <a href="{{ action('Backend\UserRolesController@create') }}"><i class="fa fa-users"></i> Assign roles to users</a>
                </li>
                <li class={{ (Request::segment(3) == 'roles') ? 'active' : '' }}>
                    <a href="#">
                        <i class="fa fa-fw fa-remove"></i> Revoke Roles from user
                    </a>
                </li>
            </ul>
        </li>
        <li class={{ (Request::segment(3) == 'users') ? 'active' : '' }}>
            <a href="{{ action('Backend\UsersController@index') }}"><i class="fa fa-fw fa-user"></i> Users</a>
        </li>
        <li class={{ (Request::segment(3) == 'products') ? 'active' : '' }}>
            <a href="{{ action('Backend\ProductsController@index') }}"><i class="fa fa-fw fa-desktop"></i> Products</a>
        </li>
        <li class={{ (Request::segment(3) == 'brands') ? 'active' : '' }}>
            <a href="{{ action('Backend\BrandsController@index') }}"> Product brands</a>
        </li>
        <li class={{ (Request::segment(3) == 'categories') ? 'active' : '' }}>
            <a href="{{ action('Backend\CategoriesController@index') }}"><i class="fa fa-fw fa-info"></i> Categories</a>
        </li>
        <li class={{ (Request::segment(3) == 'subcategories') ? 'active' : '' }}>
            <a href="{{ action('Backend\SubCategoriesController@index') }}">
                <i class="fa fa-fw fa-forward"></i> Sub-Categories
            </a>
        </li>
    </ul>
</div>
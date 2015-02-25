<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head">
        <i class="icon fa fa-align-justify fa-fw"></i>
        Shop by Category
    </div>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            @foreach($categories = array_get($data, 'categories') as $category)
                <li class="dropdown menu-item">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown">
                        {{ beautify($category->name) }}
                    </a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="links list-unstyled">
                                        @foreach($category->subcategories as $subcat)
                                            <li>
                                                <a href="{{ route('subcategories.view', ['name' => $category->name, 'id' => $subcat->id]) }}">
                                                    {{ beautify($subcat->name) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu -->
                </li>
            @endforeach
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
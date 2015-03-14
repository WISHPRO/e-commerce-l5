<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head">
        <i class="icon fa fa-align-justify fa-fw"></i>
        Shop by Category
    </div>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            @foreach($categories as $category)
                <li class="dropdown menu-item">
                    <a href="{{ route('f.categories.view', ['id' => $category->id, 'name' => preetify($category->name)]) }}" class="dropdown-toggle"
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
                                                <a href="{{ route('f.subcategories.view', ['id' => $subcat->id, 'name' => preetify($subcat->name)]) }}">
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
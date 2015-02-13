<div class="container">
    <div class="row">
        <div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary btn-lg" data-target="#"
               href="#">
                Shop by category <span class="caret"></span>
            </a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                @foreach($categories = array_get($data, 'categories') as $category)
                    <li class="dropdown-submenu">
                        <a tabindex="-1" href="#">{{ $category->name }}</a>

                        @foreach($category->subcategories as $subcategory)
                            <ul class="dropdown-menu">
                                @foreach($category->subcategories as $subcategory)
                                    <li>
                                        <a href="#">{{ $subcategory->name }}</a>
                                    </li>
                                    <li class="divider"></li>
                                @endforeach
                            </ul>
                        @endforeach
                    </li>
                    <li class="divider"></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
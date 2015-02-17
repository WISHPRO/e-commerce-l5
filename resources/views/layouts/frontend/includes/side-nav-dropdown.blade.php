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
                    <a tabindex="-1" href="{{ route('f.categories.view', ['id' => $category->id]) }}">
                        {{ beautify($category->name) }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($category->subcategories as $subcategory)
                        <li>
                            <a href="{{ route('f.subcategories.view', ['id' => $subcategory->id]) }}">
                                {{ beautify($subcategory->name) }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
                <li class="divider"></li>
                <li>
                    {!! link_to_route('f.categories.display', 'View all Categories') !!}
                </li>
            </ul>
        </div>
    </div>
</div>
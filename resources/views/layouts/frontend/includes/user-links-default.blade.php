<ul class="dropdown-menu">
    <li>
        <a href="{{ route('login') }}">
            <button class="btn btn-upper btn-primary btn-block m-t-10">
                <i class="fa fa-sign-in"></i> Sign In
            </button>

        </a>
    </li>
    <li class="p-all-10">
        <h6>New customer? please {!! link_to_route('register', 'create an account') !!}</h6>
    </li>
</ul>
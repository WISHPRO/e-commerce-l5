@if(Auth::user()->hadShoppingCart())
    <ul class="dropdown-menu">
        <li>
            <div class="shopping-cart">

                <div class="alert alert-info">
                    <p>Your shopping cart is empty. </p>
                    <br/>
                    click {!! link_to_route('mycart', 'here') !!} to see items you may have added from another computer
                    or
                    device.
                </div>
            </div>
        </li>
    </ul>
@endif
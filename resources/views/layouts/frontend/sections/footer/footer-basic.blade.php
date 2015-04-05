<div class="container">
    <div class="row m-t-30 checkout-footer">
        <div class="col-md-4 p-all-10 m-b-20">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('cart.view') }}">Your cart</a>
                </li>
                <li>
                    <a href="{{ route('terms') }}">Terms of use</a>
                </li>
            </ul>
        </div>
        <div class="col-md-4 p-all-10 m-b-20">
            <p class="text text-center bold">
                &copy; PC World {{ date('Y') }}
            </p>
        </div>
    </div>
</div>

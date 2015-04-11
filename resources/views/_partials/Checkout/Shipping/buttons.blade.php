@if(Auth::check())
    <div class="m-t-10">
        <a href="{{ route('u.checkout.step3') }}">
            <button class="btn btn-success pull-right">
                Proceed to payment page&nbsp;<i class="fa fa-arrow-right"></i>
            </button>
        </a>
    </div>
@else

    <div class="m-t-10">
        <a href="{{ route('checkout.step3') }}">
            <button class="btn btn-success pull-right">
                Proceed to payment page&nbsp;<i class="fa fa-arrow-right"></i>
            </button>
        </a>
    </div>

@endif
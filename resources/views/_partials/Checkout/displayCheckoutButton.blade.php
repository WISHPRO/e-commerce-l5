<div class="col-md-4 col-md-offset-8 m-b-20">
    @if(!$is_logged_in)
        <a href="{{ route('checkout.step1') }}">
            <button class="btn btn-success pull-right">
                Proceed to checkout &nbsp;<i class="fa fa-arrow-right"></i>
            </button>
        </a>
    @else
        <a href="{{ route('u.checkout.step2') }}">
            <button class="btn btn-success pull-right">
                Proceed to checkout &nbsp;<i class="fa fa-arrow-right"></i>
            </button>
        </a>
    @endif
</div>

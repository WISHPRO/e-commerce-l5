<div class="col-xs-3 bs-wizard-step {{ isset($state) ? $state : "disabled" }}"><!-- complete -->
    <div class="text-center bs-wizard-stepnum">Step 2</div>
    <div class="progress">
        <div class="progress-bar"></div>
    </div>
    <a href="{{ route('checkout.step2') }}" class="bs-wizard-dot"></a>

    <div class="bs-wizard-info text-center">Shipping information</div>
</div>
<div class="well">
    <p class="bold">In home delivery
        to {{ $data->home_address }}: <span
                class="text-info">{{  $cart->getShippingSubTotal() }}</span></p>

    <p class="text-info">{{ $cart->productShippingCostNotAvailable() ? "Shipping is free for this item(s)" : "Shipping is not free for this item(s)"}}</p>
</div>
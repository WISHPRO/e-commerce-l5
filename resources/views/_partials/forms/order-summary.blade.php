<h3>Order summary (Ksh)</h3>

@foreach($cart->products as $product)
    <table class="table table-bordered">
        <tr>
            <th class="bold">Products:</th>
            <td>{{ $cart->getProductPrice($product)  }}</td>
        </tr>
        <tr>
            <th class="bold">Shipping & handling:</th>
            <td>0</td>
        </tr>
        <tr>
            <th class="bold">Tax (VAT):</th>
            <td>{{ $product->calculateTax() }}</td>
        </tr>
        <tr>
            <th>
                <h4 class="bold">
                    Order total
                </h4>
            </th>
            <td>
                <h4 class="bold">
                    {{ $cart->getSubTotal(true) }}
                </h4>
            </td>
        </tr>
    </table>
@endforeach
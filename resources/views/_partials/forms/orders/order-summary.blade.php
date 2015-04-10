<h3>Order summary => ({{ $cart->getAllProductsQuantity() }}) item(s)</h3>

    <table class="table table-bordered">
        <tr>
            <th class="bold">Total cost:</th>
            <td>{{ $cart->getCartSubTotal()  }}</td>
        </tr>
        <tr>
            <th class="bold">Shipping & handling:</th>
            <td>{{ $cart->getShippingSubTotal() }}</td>
        </tr>
        <tr>
            <th class="bold">Tax (VAT):</th>
            <td>{{ $cart->getCartTaxSubTotal() }}</td>
        </tr>
        <tr>
            <th>
                <h4 class="bold">
                    Order total:
                </h4>
            </th>
            <td>
                <h4 class="bold">
                    {{ $cart->getGrandTotal() }}
                </h4>
            </td>
        </tr>
    </table>
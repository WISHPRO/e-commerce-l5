<?php namespace app\Antony\DomainLogic\Modules\Invoices;

use App\Events\OrderWasSubmitted;
use Illuminate\Support\Collection;

trait InvoicingTrait
{

    protected $invoice_data;

    /**
     * @param bool $sendNow
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createInvoice($sendNow = false)
    {
        // save invoice
        // $this->invoiceRepository->
        if ($sendNow) {

            $this->sendInvoice();

            return redirect()->route(!is_null(auth()->user()) ? 'u.checkout.viewInvoice' : 'checkout.viewInvoice');
        }

        flash()->overlay("Your order was successful. Thank you for shopping with us");

        return redirect()->route(!is_null(auth()->user()) ? 'u.checkout.viewInvoice' : 'checkout.viewInvoice');
    }

    /**
     * generate a customized data structure for our invoice
     */
    public function invoice_data()
    {
        $data = new Collection();
        if (!is_null($this->invoice_data)) {

            return $this->invoice_data;

        } else {

            $this->invoice_data = $this->getDataForInvoice();

            //dd($this->invoice_data);

            foreach ($this->invoice_data as $order) {

                $data->push($order);

                foreach ($order->users as $user) {

                    $data->push($user);
                }

                $data->push($order->data);

            }

            $this->invoice_data = $data;

            return $data;
        }

    }

    /**
     * @return $this
     */
    public function sendInvoice()
    {
        event(new OrderWasSubmitted($this->invoice_data));
    }

    /**
     * @return mixed
     */
    public function getInvoiceData()
    {
        $data = $this->invoice_data();

        $order = $data->get('0');

        $user = $data->get('1');

        $cart_data = $data->get('2');

        return ['order' => $order, 'user' => $user, 'cart_data' => $cart_data];
    }

    public function retrieveOrderInvoice($order_id)
    {

    }
}
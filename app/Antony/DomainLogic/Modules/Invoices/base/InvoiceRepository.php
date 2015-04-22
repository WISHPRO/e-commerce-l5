<?php namespace app\Antony\DomainLogic\Modules\Invoices\base;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use app\Models\Invoice;

class InvoiceRepository extends EloquentDataAccessRepository
{
    /**
     * @param Invoice $invoice
     */
    public function __construct(Invoice $invoice)
    {
        parent::__construct($invoice);
    }

    /**
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        $this->model->creating(function ($invoice) use ($data) {

            $invoice->id = $this->generateInvoiceID();

        });

        $this->model->order()->associate(array_get($data, 'order'));

        return parent::add($data);
    }

    /**
     * @return int|number
     */
    public function generateInvoiceID()
    {
        return int_random(10000, 9999999, 5);
    }
}
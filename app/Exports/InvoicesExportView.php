<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class InvoicesExportView implements FromView
{

    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function view(): View
    {
        $fromDate = $this->request->from_date;
        $toDate = $this->request->to_date;
        $invoices = Invoice::whereBetween('date', [$fromDate, $toDate]);
        return view('invoice.table', [
            'invoices' => $invoices,
        ]);
        // TODO: Implement view() method.
    }
}

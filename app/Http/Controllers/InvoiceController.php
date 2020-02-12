<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Client;
use App\Invoice;
use App\InvoiceItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use NumberFormatter;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::with(['client'])->get();

        return view('invoice.index', ['invoices' => $invoices]);
    }

    public function create(Booking $booking = null) {
        $invoice_no = Invoice::max('invoice_no');
        if($invoice_no == null) {
            $invoice_no = 0;
        }

        if($booking != null) {
            return view('invoice.create', ['booking' => $booking, 'invoice_no' => $invoice_no + 1]);
        }
        else {
            return view('invoice.create', ['invoice_no' => $invoice_no +1]);
        }

    }

    public function store(Request $request) {


        $this->validate($request, [
                'invoice_no' => 'required|unique:invoices',
                'date' => 'required',
                'client_id' => 'required',
                'grand_total' => 'required',
                'lines.*.item_name' => 'required',
                'lines.*.item_quantity' => 'required',
                'lines.*.item_price' => 'required',
                'lines.*.item_total' => 'required',
            ],
            ['required' => 'Laukas privalomas']
        );


        $invoice = new Invoice();
        $invoice->invoice_no = $request->invoice_no;
        $invoice->date = $request->date;
        $invoice->payment_date = $request->payment_date;
        $invoice->client_id = $request->client_id;
        $invoice->total = $request->grand_total*100;

        $invoice->save();


        $lines = $request->lines;
        foreach ($lines as $line) {
            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->name = $line['item_name'];
            $invoice_item->quantity = $line['item_quantity'];
            $invoice_item->price = $line['item_price']*100;
            $invoice_item->total = $line['item_total']*100;
            $invoice_item->save();
        }
        return redirect()->route('invoices')->with('success', 'Išsaugota');
    }

    public function edit($id) {
        $invoice = Invoice::find($id);

        return view('invoice.edit', ['invoice' => $invoice] );

    }

    public function getPDF(Invoice $invoice) {
        $vat = 0.21;
        $vat_total = $invoice->total * $vat;
        $grand_total = $invoice->total + $vat_total;
        $whole = floor($grand_total/100);
        $decimal = $grand_total % 100;
        $fmt= new NumberFormatter('lt', NumberFormatter::SPELLOUT);
        $total_string = $fmt->format(($whole)).' eur. ir '.$fmt->format($decimal).' ct.';
        $pdf = PDF::loadView('invoice.pdf', ['invoice' => $invoice,
                                            'vat_total' => $vat_total,
                                            'grand_total' => $grand_total,
                                            'total_string' => $total_string
                                            ]);
        return $pdf->stream('invoice.pdf');
    }
}



//TODO:
// make a PDF view file and implement creating PDF from a created invoice.
// Allow to edit invoice, check in validation if it exists already.
// Allow to edit/delete invoices.
// Add pay at date field in invoice.create and model

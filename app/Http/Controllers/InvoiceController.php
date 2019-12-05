<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Invoice;
use App\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::all();

        return view('invoice.index', ['invoices' => $invoices]);
    }

    public function create(Booking $booking) {
        $invoice_no = Invoice::max('invoice_no');
        if($invoice_no == null) {
            $invoice_no = 0;
        }

        return view('invoice.create', ['booking' => $booking, 'invoice_no' => $invoice_no + 1]);
    }

    public function store(Request $request, Booking $booking) {

        $this->validate($request, [
                'invoice_no' => 'required|unique:invoices',
                'date' => 'required',
                'client_id' => 'required',
                'total' => 'required',
                '*.item_name' => 'required',
                '*.item_quantity' => 'required',
                '*.item_price' => 'required',
                '*.item_total' => 'required',
            ],
            ['required' => 'Laukas privalomas']
        );

        $invoice = new Invoice();
        $invoice->invoice_no = $request->invoice_no;
        $invoice->date = $request->date;
        $invoice->client_id = $booking->client_id;
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

        return redirect()->route('invoices')->with('success', 'Kažkas buvo');

        //TODO:
        // write validation rules for invoice and lines.
        // make a PDF view file and implement creating PDF from a created invoice.
        // hidden input on invoice create with grandTotal value;
        // Input field with invoice serial number. Fetch max value from DB and increment by 1. Allow to edit, check
        // in validation if it exists already.
        // Allow to edit/delete invoices.
        // Add deferred payment days to invoice table
        // Add payment @date in invoice.create and model
        // Write validation for 2d array of invoice items


    }
}

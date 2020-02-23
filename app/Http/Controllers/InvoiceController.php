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
        $bookings = \DB::table('bookings')->where('invoiced', '=', 0)->get();
        $invoice_no = Invoice::max('invoice_no');
        if($invoice_no == null) {
            $invoice_no = 0;
        }

        if($booking != null) {
            return view('invoice.create', ['booking' => $booking, 'invoice_no' => $invoice_no + 1]);
        }
        else {
            return view('invoice.create', ['invoice_no' => $invoice_no +1, 'bookings' => $bookings]);
        }

    }

    public function store(Request $request) {


        $this->validate($request, [
                'invoice_no' => 'required|unique:invoices,invoice_no',
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
        if(isset($request->vat)) {
            $invoice->vat = $request->vat;
        } else {
            $invoice->vat = 0;
        }
        $invoice->save();

        $lines = $request->lines;
        foreach ($lines as $line) {
            //checks if booking is selected and sets it as invoiced
            $booking_id = $line['booking_id'];
            if($booking_id != null) {
                $booking = Booking::find($booking_id);
                $booking->invoiced = 1;
                $booking->save();
            }
            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->name = $line['item_name'];
            $invoice_item->quantity = $line['item_quantity'];
            $invoice_item->price = $line['item_price']*100;
            $invoice_item->total = $line['item_total']*100;
            $invoice_item->booking_id = $booking_id;
            $invoice_item->save();
        }
        return redirect()->route('invoices')->with('success', 'Išsaugota');
    }

    public function edit($id) {
        $invoice = Invoice::find($id);
        $bookings = \DB::table('bookings')->where('client_id', '=', $invoice->client_id)->get();
        return view('invoice.edit', ['invoice' => $invoice, 'bookings' => $bookings]);

    }

    public function update($id, Request $request) {



        $this->validate($request, [
            'invoice_no' => "required|unique:invoices,invoice_no,$id",
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


        $invoice = Invoice::find($id);
        $invoice->invoice_no = $request->invoice_no;
        $invoice->date = $request->date;
        $invoice->payment_date = $request->payment_date;
        $invoice->client_id = $request->client_id;
        $invoice->total = $request->grand_total*100;
        if(isset($request->vat)) {
            $invoice->vat = $request->vat;
        } else {
            $invoice->vat = 0;
        }


        $invoice->save();

        $old_lines = $invoice->items;
        foreach ($old_lines as $line) {
            if($line->booking_id != null) {
                $booking = Booking::find($line->booking_id);
                $booking->invoiced = 0;
                $booking->save();
            }
            InvoiceItem::destroy($line->id);
        }


        $lines = $request->lines;
        foreach ($lines as $line) {
            if(isset($line['booking_id'])) {
                $booking_id = $line['booking_id'];
                if($booking_id != null) {
                    $booking = Booking::find($booking_id);
                    $booking->invoiced = 1;
                    $booking->save();
                }
            } else {
                $booking_id = null;
            }
            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->name = $line['item_name'];
            $invoice_item->quantity = $line['item_quantity'];
            $invoice_item->price = $line['item_price']*100;
            $invoice_item->total = $line['item_total']*100;
            $invoice_item->booking_id = $booking_id;
            $invoice_item->save();
        }
        return redirect()->route('invoices')->with('success', 'Išsaugota');
    }

    public function getPDF(Invoice $invoice) {
        if($invoice->vat == 1) {
            $vat = 0.21;
        } else {
            $vat = 0;
        }

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

    public function delete($id) {
        $invoice = Invoice::find($id);
        foreach ($invoice->items as $line) {
            if($line->booking_id != null) {
                $booking = Booking::find($line->booking_id);
                $booking->invoiced = 0;
                $booking->save();
            }
        }
        Invoice::destroy($id);
        return redirect()->route('invoices');
    }
}



//TODO:
// Allow to edit invoice, check in validation if it exists already.
// Select2 get selected value from ajax

<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::all();

        return view('invoice.index', ['invoices' => $invoices]);
    }

    public function create(Booking $booking) {

        return view('invoice.create', ['booking' => $booking]);
    }

    public function store(Request $request) {
        dd($request->lines);
    }
}

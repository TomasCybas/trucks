<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Driver;
use App\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingsFilterController extends Controller
{
    public function filterBookings (Request $request) {
        $query = [];
        $filterData = $request->except('_token');
        foreach ($filterData as $field => $value) {
            if($value != null){
                $query[$field] = $value;
            }
        }
        if(sizeof($query) <= 0) {
            return redirect()->route('bookings')->with('error', 'Norėdami filtruoti pasirinkite filtrą');
        }

        $bookings = Booking::with([
            'driver',
            'truck',
            'client',
            'loadingCity',
            'unloadingCity'
        ])->where($query)->get();
        $drivers = Driver::all();
        $trucks = Truck::all();

        if($bookings->isEmpty()){
            return redirect()->route('bookings')->with('error', 'Nėra rezultatų su pasirinktais parametrais');
        }
        else {
            return view('booking.index', [
                'bookings' => $bookings,
                'drivers' => $drivers,
                'trucks' => $trucks,
            ]);
        }



    }
}

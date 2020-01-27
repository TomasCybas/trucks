<?php

namespace App\Http\Controllers;

use App\Booking;
use App\City;
use App\Driver;
use App\Truck;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        $drivers = Driver::all();
        $trucks = Truck::all();
        $bookings = Booking::with([
            'client',
            'loadingCity',
            'unloadingCity',
            'truck',
            'driver',
        ])->orderBy('created_at', 'desc')->get();
        return view('booking.index', [
            'bookings' => $bookings,
            'drivers' => $drivers,
            'trucks' => $trucks,
        ]);
    }

    public function create(){
        $trucks = Truck::all();
        $drivers = Driver::all();

        return view('booking.create', [
            'drivers' => $drivers,
            'trucks' => $trucks,
        ]);
    }

    public function store(Request $request){

        $this->validate($request, [
            'client_id' => 'required',
            'container_type' => 'required',
            'loading_city_id' => 'required',
            'unloading_city_id' => 'required',
            'type' => 'required',
            'container_no' => 'required',
            'loading_date' => 'required',
            'driver_id' => 'required',
            'truck_id' => 'required',
            'vat' => 'required',
            'price' => 'required',
        ],
            [
                'required' => 'Laukas privalomas'
            ]);

        $booking = new Booking();
        $booking->client_id = $request->client_id;
        $booking->container_type = $request->container_type;
        $booking->loading_city_id = $request->loading_city_id;
        $booking->unloading_city_id = $request->unloading_city_id;
        $booking->type = $request->type;
        $booking->container_no = $request->container_no;
        $booking->loading_date = $request->loading_date;
        $booking->driver_id = $request->driver_id;
        $booking->truck_id = $request->truck_id;
        $booking->vat = $request->vat;
        $booking->price =  (float)$request->price*100;
        $booking->save();
        return redirect()->route('bookings')->with('success', 'Užsakymas sukurtas.');
    }

    public function edit($id){
        $booking = Booking::find($id);
        $trucks = Truck::all();
        $drivers = Driver::all();

        return view('booking.edit', [
            'booking' => $booking,
            'drivers' => $drivers,
            'trucks' => $trucks,
        ]);
    }

    public function update($id, Request $request){

        $this->validate($request, [
            'client_id' => 'required',
            'container_type' => 'required',
            'loading_city_id' => 'required',
            'unloading_city_id' => 'required',
            'type' => 'required',
            'container_no' => 'required',
            'loading_date' => 'required',
            'driver_id' => 'required',
            'truck_id' => 'required',
            'vat' => 'required',
            'price' => 'required',
        ],
            [
                'required' => 'Laukas privalomas'
            ]);

        $booking = Booking::find($id);
        $booking->client_id = $request->client_id;
        $booking->container_type = $request->container_type;
        $booking->loading_city_id = $request->loading_city_id;
        $booking->unloading_city_id = $request->unloading_city_id;
        $booking->type = $request->type;
        $booking->container_no = $request->container_no;
        $booking->loading_date = $request->loading_date;
        $booking->driver_id = $request->driver_id;
        $booking->truck_id = $request->truck_id;
        $booking->vat = $request->vat;
        $booking->price =  (float)$request->price*100;
        $booking->save();

        return redirect()->route('bookings')->with('success', 'Užsakymas atnaujintas.');

    }

    public function delete($id){
        Booking::destroy($id);
        return redirect()->route('bookings')->with('success', 'Užsakymas ištrintas.');
    }
//TODO: add /show method
}

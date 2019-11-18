<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingsFilterController extends Controller
{
    public function filterBookings (Request $request) {
        $filterData = [];
        if($request->has('client_id')) {
            $filterData['client_id'] = $request->client_id;
        }
        dd($filterData);


        //TODO: push all values into array with keys, then loop through it and build a usable query



        //$bookings = DB::table('bookings')->where($query)->get();

    }
}

<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function create(){
        return view('city.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'country_name' => 'required',
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->country_name = $request->country_name;
        $city->save();

        return redirect()->route('booking.create');


    }
    //TODO: add create method, validation
}

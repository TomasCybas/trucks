<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(){
        $drivers = Driver::all()->reverse();
        return view('driver.index', ['drivers' => $drivers]);
    }

    public function create(){
        return view('driver.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'date_of_birth' => 'required',
            'driver_license_no' => 'required',
        ],
            [
                'required' => 'Laukas privalomas'
            ]);


        $driver = new Driver();
        $driver->name = $request->name;
        $driver->surname = $request->surname;
        $driver->date_of_birth = $request->date_of_birth;
        $driver->driver_license_no = $request->driver_license_no;
        $driver->save();
        return redirect()->route('drivers')->with('success' , "Pridėtas vairuotojas $driver->name $driver->surname.");

    }

    public function edit($id){
        $driver = Driver::find($id);
        return view('driver.edit', ['driver' => $driver]);
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'date_of_birth' => 'required',
            'driver_license_no' => 'required',
        ]);
        $driver = Driver::find($id);

        $driver->name = $request->name;
        $driver->surname = $request->surname;
        $driver->date_of_birth = $request->date_of_birth;
        $driver->driver_license_no = $request->driver_license_no;
        $driver->save();
        return redirect()->route('drivers')->with('success' , "Vairuotojo $driver->name $driver->surname informacija atnaujinta.");

    }

    public function delete($id){
        $driver = Driver::find($id);
        Driver::destroy($id);
        return redirect()->route('drivers')->with('success', "Vairuotojas $driver->name ištrintas.");
    }
}
//TODO: add validation error handling

<?php

namespace App\Http\Controllers;

use App\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index(){
        $trucks = Truck::all()->reverse();
        return view('truck.index', ['trucks' => $trucks]);
    }

    public function create(){
        return view('truck.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'brand' => 'required',
            'model' => 'required',
            'reg_number' => 'unique:trucks,reg_number',
        ],
            [
                'reg_number.unique' => 'Sunkvežimis su tokiu valst. nr. jau egzistuoja.',
                'required' => 'Laukas privalomas',

            ]);
        $truck = new Truck();
        $truck->brand = $request->brand;
        $truck->model = $request->model;
        $truck->reg_number = $request->reg_number;
        $truck->save();
        return redirect()->route('trucks')->with('success', 'Sunkvežimis  pridėtas.');
    }

    public function delete($id){
        Truck::destroy($id);
        return redirect()->route('trucks')->with('success', 'Sunkvežimis  ištrintas');
    }
}
//TODO: add edit/update methods

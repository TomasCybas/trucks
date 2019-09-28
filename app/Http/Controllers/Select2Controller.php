<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Select2Controller extends Controller
{
    public function citySelect2(Request $request){
        $querry = $request->term;
        $cities = DB::table('cities')->where('name', 'LIKE', '%' .$querry. '%')->get();
        $result = [];
        foreach ($cities as $city) {
            $result[] = [
                'id' => $city->id,
                'text' => $city->name
            ];
        }
        return ['results' => $result];
    }

    public function clientSelect2(Request $request){
        $querry = $request->term;
        $clients = DB::table('clients')->where('name', 'LIKE', $querry. '%')->
        orWhere('company_code', 'LIKE', '%' .$querry. '%')->get();
        $result = [];
        foreach ($clients as $client) {
            $result[] = [
                'id' => $client->id,
                'text' => $client->name
            ];
        }
        return ['results' => $result];
    }

    public function truckSelect2(Request $request){
        $querry = $request->term;
        $trucks = DB::table('trucks')->where('brand', 'LIKE', $querry. '%')->
        orWhere('model', 'LIKE', '%' .$querry. '%')->
            orWhere('reg_number', 'LIKE', '%' .$querry. '%')->get();
        $result = [];
        foreach ($trucks as $truck) {
            $result[] = [
                'id' => $truck->id,
                'text' => $truck->brand.' '.$truck->model.' '.$truck->reg_number
            ];
        }
        return ['results' => $result];
    }


    public function driverSelect2(Request $request){
        $querry = $request->term;
        $drivers = DB::table('drivers')->where('name', 'LIKE', $querry. '%')->
        orWhere('surname', 'LIKE', '%' .$querry. '%')->get();
        $result = [];
        foreach ($drivers as $driver) {
            $result[] = [
                'id' => $driver->id,
                'text' => $driver->name.' '.$driver->surname
            ];
        }
        return ['results' => $result];
    }


}

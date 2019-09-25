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
}

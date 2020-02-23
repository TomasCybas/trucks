<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function loadingCity(){
        return $this->belongsTo('App\City', 'loading_city_id', 'id');
    }

    public function unloadingCity(){
        return $this->belongsTo('App\City', 'unloading_city_id', 'id');
    }

    public function truck(){
        return $this->belongsTo('App\Truck');
    }

    public function driver(){
        return $this->belongsTo('App\Driver');
    }
    public function invoiceItem() {
        return $this->belongsTo('App\InvoiceItem');
    }




}

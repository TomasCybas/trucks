<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    //TODO rename methods more appropriately
    public function bookingsUnload(){
        return  $this->hasMany('App\Booking', 'id', 'unloading_city_id');
    }

    public function bookingsLoad(){
        return  $this->hasMany('App\Booking', 'id', 'loading_city_id');
    }
}

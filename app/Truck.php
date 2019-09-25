<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    //
    public function bookings(){
        return $this->hasMany('App\Booking');
    }
}

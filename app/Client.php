<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function bookings(){
        return $this->hasMany('App/Booking');
    }

    public function invoices() {
        return $this->hasMany('App/Invoice');
    }
}

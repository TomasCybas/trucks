<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    public function invoice() {
        return $this->belongsTo('App\Invoice');
    }

    public function booking() {
        return $this->belongsTo('App\Booking');
    }
}

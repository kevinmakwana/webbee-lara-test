<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function movieShows(){
        return $this->belongsTo(MovieShow::class);
    }

    public function showSeats(){
        return $this->hasMany(ShowSeat::class);
    }

    public function payment(){
        return $this->hasOne(BookingPayment::class);
    }
}

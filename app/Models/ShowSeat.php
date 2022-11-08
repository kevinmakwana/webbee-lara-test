<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowSeat extends Model
{
    use HasFactory;

    public function cinemaHallSeat(){
        return $this->hasOne(CinemaHallSeat::class);
    }

    public function movieShow(){
        return $this->hasOne(MovieShow::class);
    }

    public function booking(){
        return $this->hasOne(Booking::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaHallSeat extends Model
{
    use HasFactory;

    public function cinemaHall(){
        return $this->belongsTo(CinemaHall::class);
    }

    public function showSeat(){
        return $this->belongsTo(ShowSeat::class);
    }
}

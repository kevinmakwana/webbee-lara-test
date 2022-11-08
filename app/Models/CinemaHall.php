<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaHall extends Model
{
    use HasFactory;

    public function cinema(){
        return $this->belongsTo(Cinema::class);
    }

    public function movieShows(){
        return $this->hasMany(MovieShow::class);
    }

    public function cinemaHallSeats(){
        return $this->hasMany(CinemaHallSeat::class);
    }
}

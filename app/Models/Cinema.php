<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    public function owner(){
        return $this->belongsTo(CinemaOwner::class);
    }

    public function cinemaHalls(){
        return $this->hasMany(CinemaHall::class);
    }
}

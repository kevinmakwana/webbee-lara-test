<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaOwner extends Model
{
    use HasFactory;

    public function cinemas(){
        return $this->hasMany(Cinema::class);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function movieExploration(){
        $time = Carbon::now();

        $movies = Movie::with('movieShows')->whereHas('movieShows',function($q) use($time){
            $q->where('start_time',$time->subHour()->format('Y-m-d H:i:s'))
            ->where('status','!=','housefull');
        })->where('release_date','>=',$time->format('Y-m-d H:i:s'))->get(); 
        return response()->json($movies,200);
    }
}

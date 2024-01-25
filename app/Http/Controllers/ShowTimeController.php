<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShowTime;
use Illuminate\Support\Facades\DB;

class ShowTimeController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        return ShowTime::all();
    }

    public function store(Request $request){
        $validatedData = $this->validate($request, [
            'movie_id' => 'required|numeric',
            'cinema_id' => 'required|numeric',
            'time' => 'required|date_format:H:i A'
        ]);
        
        $m = DB::select('SELECT movieID FROM movies WHERE movieID = ?', [$validatedData["movie_id"]]);
        $c = DB::select('SELECT cinameID FROM cinema WHERE cinameID = ?', [$validatedData["cinema_id"]]);
        
        if(count($m) == 0){
            return "Vui lòng kiểm tra lại movieID";
        }
        else if(count($c) == 0){
            return "Vui lòng kiểm tra lại cinameID";
        }
        else{
            return ShowTime::create([
                'movie_id' => $request->movie_id,
                'cinema_id' => $request->movie_id,
                'time' => $request->time
            ]);
        }

    }
}
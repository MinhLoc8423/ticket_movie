<?php

namespace App\Http\Controllers;

use App\Models\ShowTime;

class ShowTimeController extends Controller
{
    public function __construct()
    {
    }

    public function all(){
        return ShowTime::all();
    }
}
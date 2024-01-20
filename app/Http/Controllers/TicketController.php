<?php

namespace App\Http\Controllers;

use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function __construct()
    {
    }

    public function create(Request $request){
        $ticket = $request->all();
        $response = array();
        if(is_numeric($ticket["movie_id"]) && is_numeric($ticket["price"]) && is_numeric($ticket["show_time_id"]) && is_numeric($ticket["cinema_id"]) && is_numeric($ticket["seat_id"])){
            $response = Ticket::create($ticket);
            return response([$response, "status"=>200]);
        }else{
            return response()->json(['error' => 'Lỗi giá trị vui lòng nhập lại'], 401);
        }
    }
}
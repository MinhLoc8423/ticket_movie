<?php

namespace App\Http\Controllers;

use App\Models\ShowTime;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        return response()->json([       
            'status' => 200,
            "data" => Ticket::all()->where('is_disabled', 0)
        ]); 
    }

    public function store(Request $request){
        $validatedData = Validator::make($request->all(), [
            'movie_id' => 'required|numeric',
            'price' => 'required|numeric',
            'show_time_id' => 'required|numeric',
            'cinema_id' => 'required|numeric',
            'seat_id' => 'required|numeric'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validatedData->messages()
            ]); 
        }

        $movieID = $validatedData->validated()["movie_id"];
        $showtimeID = $validatedData->validated()["show_time_id"];
        $cinemaID = $validatedData->validated()["cinema_id"];
        $seatID = $validatedData->validated()["seat_id"];
        $m = DB::select('SELECT movieID FROM movies WHERE movieID = ?', [$movieID]);
        $sh = DB::select('SELECT showtimeID FROM showtime WHERE showtimeID = ?', [$showtimeID]);
        $c = DB::select('SELECT cinameID FROM cinema WHERE cinameID = ?', [$cinemaID]);
        $se = DB::select('SELECT seatsID FROM seats WHERE seatsID = ?', [$seatID]);
        
        
        if(count($m) == 0){
            return response()->json([       
                'status' => 400,
                "message" => "Pls check again movieID"
            ]);
        }
        else if(count($c) == 0){
            return response()->json([       
                'status' => 400,
                "message" => "Pls check again cinameID"
            ]);
        }
        else if(count($sh) == 0){
            return response()->json([       
                'status' => 400,
                "message" => "Pls check again show_time_id"
            ]);
        }
        else if(count($se) == 0){
            return response()->json([       
                'status' => 400,
                "message" => "Pls check again seat_id"
            ]);
        }
        else{
            $i = Ticket::create([
                'movie_id' => $request->movie_id,
                'price' => $request->price,
                'show_time_id' => $request->show_time_id,
                'cinema_id' => $request->cinema_id,
                'seat_id' => $request->seat_id,
                'is_actived' => 0,
                'is_refunded' => 0,
            ]);
            return response()->json([       
                'status' => 200,
                "data" => $i
            ]); 
        }
    }

    public function update(Request $request, $id){
        try {
            $time1 = Ticket::find($id)->show_time_id;
            $showtime  = ShowTime::find($time1);
            $nextShowtime = Showtime::where('time', '>', $showtime->time)->first();
            if($nextShowtime){
            $ticket = Ticket::find($id);
                    $ticket->update(['show_time_id' => $nextShowtime->showtimeID]);
                    return response()->json([       
                        'status' => 200,
                        "message" => "Change showtime successfully"
                    ]); 
            }
            else{
                return response()->json([       
                    'status' => 500,
                    "messages" => "Can't change showtime"
                ]); 
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        
    }

    public function destroy($id){
        $user_id = Auth::user()->role;
        if($user_id == 1){
            $data = Ticket::findOrFail($id);
            if(($data->is_actived) == 0){
                $dt = ShowTime::find($data->show_time_id);
                $time1 = date("H:i:s",  time());
                $time2 = date("H:i:s", strtotime($dt->time));
                if($time1 < $time2){
                    $ticket = Ticket::find($id);
                    $ticket->forceFill(['is_disabled' => 1])->save();
                    return response()->json([       
                        'status' => 200,
                        "message" => "Deleted successfully"
                    ]); 
                }
                else{
                    return response()->json([       
                        'status' => 400,
                        'data' => "Tickets have not expired yet"
                    ]);
                }
            }
            else{
                return response()->json([       
                    'status' => 400,
                    'data' => "Ticket has been used"
                ]); 
            }
        }
        else{
            return response()->json([       
                'status' => 400,
                'data' => "Pls login by account admin"
            ]); 
        }
    }
}
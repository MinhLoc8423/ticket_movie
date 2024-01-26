<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShowTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShowTimeController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        return response()->json([       
            'status' => 200,
            "data" => ShowTime::all()
        ]); 
    }

    public function store(Request $request){
        $validatedData = Validator::make($request->all(), [
            'movie_id' => 'required|numeric',
            'cinema_id' => 'required|numeric',
            'time' => 'required|date_format:H:i A'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validatedData->messages()
            ]); 
        }
        
        $movieID = $validatedData->validated()["movie_id"];
        $cinemaID = $validatedData->validated()["cinema_id"];
        $m = DB::select('SELECT movieID FROM movies WHERE movieID = ?', [$movieID]);
        $c = DB::select('SELECT cinameID FROM cinema WHERE cinameID = ?', [$cinemaID]);
        
        
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
        else{
            $i = ShowTime::create([
                'movie_id' => $request->movie_id,
                'cinema_id' => $request->cinema_id,
                'time' => $request->time
            ]);
            return response()->json([       
                'status' => 200,
                "data" => $i
            ]); 
        }
    }

    public function update(Request $request, $id){
        $index = ShowTime::find($id);
        if ($index) {
            $validatedData = Validator::make($request->all(), [
                'movie_id' => 'required|numeric',
                'cinema_id' => 'required|numeric',
                'time' => 'required|date_format:H:i A'
            ]);
    
            if ($validatedData->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validatedData->messages()
                ]); 
            }
            
            $movieID = $validatedData->validated()["movie_id"];
            $cinemaID = $validatedData->validated()["cinema_id"];
            $m = DB::select('SELECT movieID FROM movies WHERE movieID = ?', [$movieID]);
            $c = DB::select('SELECT cinameID FROM cinema WHERE cinameID = ?', [$cinemaID]);
            
            
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
            else{
                $index->update([
                    'movie_id' => $request->movie_id,
                    'cinema_id' => $request->cinema_id,
                    'time' => $request->time
                ]);
                return response()->json([       
                    'status' => 200,
                    "message" => "Update successfully"
                ]); 
            }
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Not found'
            ]);
        }
    }

    public function destroy($id){
        $index = ShowTime::find($id);
        if($index){
            $index->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully'
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Not found'
            ]);
        }
    }
}
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BookingHistory;
class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function index(Request $request){
        return (BookingHistory::where('user_id', $_GET['user_id'])->get());
    }
}

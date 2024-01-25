<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BookingHistory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

    public function index(){
        $user_id = Auth::user()->userID;;
        $bookingHistory = BookingHistory::where('user_id', $user_id)->get();
        if ($bookingHistory->isEmpty()){
            return response(['error' => 'Không tồn tại lịch sử đơn hàng'], 400);
        };
        return response($bookingHistory);
    }

    public function store(Request $request){
        $validatedData = $this->validate($request, [
            'ticket_id' => 'required|numeric',
            'ticket_quantity' => 'required|numeric',
        ]);

        $validatedData['booking_time'] = Carbon::now();
        $validatedData['user_id'] = Auth::user()->userID;
        
        try {
            $data = BookingHistory::create($validatedData);
            return response()->json(['Thông báo' => 'Tạo thành công' , 'data' => $data], 200);
        } catch (\Exception $error){
            return response()->json(['error'  => 'Sai dữ liệu khi tạo']);
        };

    }

    public function update(Request $request){
        
        $validatedData = $this->validate($request, [
            'bookingID' => 'required|numeric',
            'ticket_quantity' => 'required|numeric',
        ]);

        try {
            $bookinghistory = BookingHistory::where('bookingID', $validatedData['bookingID'])
                            ->update(['ticket_quantity' => $validatedData['ticket_quantity']]);

            return response()->json(['Thông báo' => 'Chỉnh sửa thành công' ], 200);
        } catch (\Exception $error){
            return response()->json(['error'  => 'Sai dữ liệu khi tạo' . $error->getMessage()]);
        };
    }

    public function destroy(){

    }
}

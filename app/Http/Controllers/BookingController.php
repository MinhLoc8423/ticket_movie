<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BookingHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        $booking_history = BookingHistory::where('user_id', $user_id)->get();
        if ($booking_history->isEmpty()){
            return response(['error' => 'Không tồn tại lịch sử đơn hàng'], 400);
        };
        return response($booking_history);
    }

    public function store(Request $request){
        $validated_data = $this->validate($request, [
            'ticket_id' => 'required|numeric',
            'ticket_quantity' => 'required|numeric',
        ]);

        $validated_data['booking_time'] = Carbon::now();
        $validated_data['user_id'] = Auth::user()->userID;
        
        try {
            $data = BookingHistory::create($validated_data);
            return response()->json(['Thông báo' => 'Tạo thành công' , 'data' => $data], 200);
        } catch (\Exception $error){
            return response()->json(['error'  => 'Sai dữ liệu khi tạo']);
        };

    }

    public function update(Request $request, $bookingID){
        $bookingID = $this->validate_bookingID($bookingID);        

        $validated_data = $this->validate($request, [
            'ticket_quantity' => 'required|numeric',
        ]);

        try {
            $booking_history = BookingHistory::where('bookingID', $bookingID)
                            ->update(['ticket_quantity' => $validated_data['ticket_quantity']]);

            return response()->json(['Thông báo' => 'Chỉnh sửa thành công', 'data' => $booking_history], 200);
        } catch (\Exception $error){
            return response()->json(['error'  => 'Sai dữ liệu khi tạo ' . $error->getMessage()]);
        };
    }

    public function destroy(Request $request, $bookingID){
        $bookingID = $this->validate_bookingID($bookingID);        
        try {
            $deleted_history = BookingHistory::where('bookingID', $bookingID)->delete();
            return response()->json(['Thông báo' => 'Xóa thành công', 'data' => $deleted_history ], 200);
        } catch (\Exception $error){
            return response()->json(['error'  => 'Lịch sử đặt vé không tồn tại' . $error->getMessage()]);
        };
    }

    public function validate_bookingID($bookingID){
        $validator = Validator::make(['bookingID' => $bookingID], [
            'bookingID' => [
                'required',
                'numeric',
                Rule::exists('booking', 'bookingID'),
            ],
        ]);

        try {
            return $validator->validate();
        } catch (\Illuminate\Validation\ValidationException $error) {
            return response()->json(['error'  => 'BookingID không tồn tại']);
        }
    }
}

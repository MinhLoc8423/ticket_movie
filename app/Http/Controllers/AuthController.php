<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\upload;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function register(Request $request){
    }

    public function login(Request $request){
        // Nếu đã mã hóa mật khẩu thì chưa kiểm tra đc
        $user = User::where('email', $request->input('email'))
            ->where('pass_word',  $request->input('password'))->first();
        if ($user) {
            return response()->json(['sucesss' => 'Đăng nhập thành công', 'token' => $user->api_token], 200);
        }
        return response()->json(['error' => 'Sai email hoặc mật khẩu'], 401);

    }

    public function uploadImage(Request $request){
        $user = upload::find($request->userID);

        if (!$user) {
            return response()->json(['error' => 'Ngươi dùng không tồn tại'], 404);
        }

        if ($request->hasFile('image')) {
            // Lấy file hình ảnh từ request
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();;// Lấy tên gốc của file
            $user->image_url = $imageName; // Cập nhật cột image_url trong cơ sở dữ liệu
            $user->save();
            return response()->json(['message' => 'Tải ảnh lên thành công', 'image_url' => $imageName]);
        } else {
            return response()->json(['error' => 'Không có ảnh'], 400);
        }
    }
}

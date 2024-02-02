<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
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
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\upload;
use Firebase\JWT\JWT;
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

    function generateToken() {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $token = '';
    
        for ($i = 0; $i < 10; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $token;
    }


    public function register(Request $request){
        $validated_data = $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        // kiểm tra có trùng email không
        $isUserExist = User::where('email', $request->input('email'))->first();
        if ($isUserExist){
            return response()->json(['error' => 'Email không được trùng'], 400);
        }
        $user =  User::create([
            'email' => $validated_data['email'],
            'pass_word' => Crypt::encrypt($validated_data['password']),
            'api_token' =>  $this->generateToken()
        ]);
       
        return response()->json(['sucesss' => 'Đăng ký thành công', 'data' => $user], 200);
    }

    public function login(Request $request){
        $user = User::where('email', $request->input('email'))->first();
        if (!$user){
            return response()->json(['error' => 'Sai email hoặc mật khẩu'], 401);
        }
        if (Crypt::decrypt($user->pass_word) == $request->input('password')){
            $payload = [
                'sub' => $user->userID,
                'iat' => time(),
                'exp' => time() + 60*60
            ];

            $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
            $user->update([
                'api_token' => $token,
            ]);
            return response()->json(['sucesss' => 'Đăng nhập thành công', 'token' => $token], 200);
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

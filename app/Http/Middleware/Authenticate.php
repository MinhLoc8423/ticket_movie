<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if ($this->auth->guard($guard)->guest()) {
    //         return response('Unauthorized.', 401);
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        // Thử giải mã token
        try {
            // Lấy token bearer từ tiêu đề yêu cầu
            $token = $request->bearerToken();

            // Kiểm tra nếu không có token, trả về lỗi 401
            if (!$token) {
                return response()->json(['error' => 'Không được phép truy cập. Token không được cung cấp.'], 401);
            }
            // Giải mã token bằng mật khẩu bí mật được lưu trong .env
            $key = env('JWT_SECRET');
            JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Firebase\JWT\ExpiredException $e) {
            return response()->json(['error' =>  $e->getMessage()], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi không xác định.'], 401);
        }

        return $next($request);
    }

    // public function handle($request, Closure $next)
    // {
    //     // Thử giải mã token
    //     try {
    //         // Lấy token bearer từ tiêu đề yêu cầu
    //         $token = $request->bearerToken();

    //         // Kiểm tra nếu không có token, trả về lỗi 401
    //         if (!$token) {
    //             return response()->json(['error' => 'Unauthorized'], 401);
    //         }
    //         // Giải mã token bằng mật khẩu bí mật được lưu trong .env
    //         $key = env('JWT_SECRET');
    //         JWT::decode($token, new Key($key, 'HS256'));
    //     } catch (\Firebase\JWT\ExpiredException $e) {
    //         return response()->json(['error' =>  $e->getMessage()], 401);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Unknown error'], 401);
    //     }

    //     return $next($request);
    // }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\VeryEmail;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            $user = User::where('email', $request->email)->first();
            if ($user != null && $user->email_verified_at == null) {
                $code = rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9);
                $data = [
                    'code' => $code
                ];
                $user->verify_code = $code;
                $user->save();
                Mail::to("$request->email")->send(new VeryEmail($data));
                return response()->json([
                    'user' => User::where('id', $user->id)->first(),
                    'massage' => 'Mã xác minh đã được gửi về email của bạn'
                ]);
            }
            if ($request->checkbox == 'on') {
                Cookie::queue('em', $request->email, 44640);
                Cookie::queue('ps', $request->password, 44640);
            }
            return response()->json(['result' => true]);
        } else return response()->json([
            'result' => false,
            'message' => 'Tài khoản hoặc mật khẩu không chính xác'
        ]);
    }

    public function register(Request $request)
    {
        $user = User::where('phone', $request->phone)->orWhere('email', $request->email)->first();
        if ($user != null) {
            return response()->json([
                'result' => false,
                'message' => 'Số điện thoại hoặc email đã tồn tại'
            ]);
        }
        $code = rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9);
        $data = [
            'code' => $code
        ];
        $new = new User();
        $new->name = $request->name;
        $new->email = $request->email;
        $new->phone = $request->phone;
        $new->password = Hash::make($request->password);
        $new->address = $request->address;
        $new->gender = $request->gender;
        $new->verify_code = $code;
        $new->save();
        Mail::to("$request->email")->send(new VeryEmail($data));
        return response()->json([
            'user' => User::where('id', $new->id)->first(),
            'massage' => 'Mã xác minh đã được gửi về email của bạn'
        ]);
    }


    public function verify(Request $request, $userId)
    {
        $user = User::where('id', $userId)->where('status', 0)->first();
        if ($user == null) {
            return response()->json(['result' => false]);
        }
        if ($request->code && $request->code == $user->verify_code) {
            $user->email_verified_at = date('Y/m/d H:i:s');
            $user->status = 1;
            $user->save();
            return response()->json([
                'result' => true,
                'massage' => 'Xác minh email thành công'
            ]);
        }
        return response()->json([
            'result' => false,
            'massage' => 'Mã xác minh không chính xác'
        ]);
    }

    public function reset_password(){

    }
}

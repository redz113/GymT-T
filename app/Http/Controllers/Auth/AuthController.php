<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Services\UploadImgService;
use App\Mail\forgotMail;
use App\Models\User;
use App\Mail\VeryEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function signup()
    {
        return view('screens.frontend.auth.signup');
    }

    public function postSignup(SignupRequest $request)
    {
        $user = User::where('phone', $request->phone)->orWhere('email', $request->email)->first();
        if ($user != null) {
            return redirect()->back()->with('error', 'Email hoặc số điện thoại bạn nhập đã tồn tại. Hãy đăng ký tài khoản khác.');
        }
        $code = rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9);
        $data = [
            'code' => $code
        ];
        $new = new User();
        $new->avatar = 'https://vtv1.mediacdn.vn/thumb_w/650/2014/incognito-chrome-spicytricks-1420018283508.jpg';
        $new->name = $request->name;
        $new->email = $request->email;
        $new->phone = $request->phone;
        $new->password = Hash::make($request->password);
        $new->address = $request->address;
        $new->gender = $request->gender;
        $new->verify_code = $code;
        $new->assignRole('member');
        $new->save();
        Mail::to("$request->email")->send(new VeryEmail($data));
        return redirect()->route('very_email', $request->email);
    }


    public function login()
    {
        return view('screens.frontend.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
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

                return redirect()->route('very_email', $request->email);
            }
            if ($request->checkbox == 'on') {
                Cookie::queue('em', $request->email, 44640);
                Cookie::queue('ps', $request->password, 44640);
            }
            return redirect()->route('home');
        } else return redirect()->back()->with('error', 'Email bạn nhập không kết nối với tài khoản nào.');
    }

    public function very_email($email)
    {
        return view('screens.frontend.auth.very-email', compact('email'));
    }
    public function post_very_email($email, Request $request)
    {

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Lỗi sai đường dẫn. Vui lòng kiểm tra lại');
        }

        if ($user->verify_code == $request->code) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->status = 1;
            $user->save();
            return redirect()->route('login');
        }
        return redirect()->back()->with('error', 'Mã xác minh không chính xác');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        // Tạo token mới
        $request->session()->regenerateToken();
        // Quay về màn login
        return redirect()->route('login');
    }

    public function resetPassword($email)
    {
        return view('screens.frontend.auth.reset_password', compact('email'));
    }

    public function postResetPassword($email, Request $request)
    {


        if ($request->password == null || $request->re_password == null) {
            return redirect()->back()->with('error', 'Bạn cần nhập đầy đủ thông tin');
        }

        if ($request->password != $request->re_password) {
            return redirect()->back()->with('error', 'Nhập lại mật khẩu không khớp');
        }

        $user = User::where('email', $request->email)->first();

        if ($user != null) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('login')->with('success', 'Cập nhật mật khẩu thành công');
    }

    public function forgotPassword()
    {
        return view('screens.frontend.auth.forgot_password');
    }

    public function postForgot(Request $request)
    {
        if ($request->email == null) {
            return redirect()->back()->with('error', 'Nhập email của bạn');
        }
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return redirect()->back()->with('error', 'Email của bạn chưa được đăng ký');
        }
        $data = [
            'email' => $request->email
        ];
        Mail::to("$request->email")->send(new forgotMail($data));

        return redirect()->back()->with('success', 'Chúng tôi đã gửi thư đến email của bạn');
    }
}

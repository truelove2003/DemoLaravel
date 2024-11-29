<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended('/user');
        }
    
        // Đăng nhập thất bại, trả về lại với thông báo lỗi
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.']);
    
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/user');
    }
}

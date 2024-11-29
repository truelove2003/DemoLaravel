<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'email' => 'required|string|email|max:255|unique:users,email',
            'hobbies' => 'nullable|string|max:255',
        ]);

        // Tạo người dùng mới
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'hobbies' => $request->hobbies,
        ]);

        // Redirect hoặc trả về response
        return redirect()->route('register.form')->with('success', 'Đăng ký thành công!');
    }
}

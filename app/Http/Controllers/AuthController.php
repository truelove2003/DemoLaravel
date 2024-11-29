<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
     // Phương thức hiển thị form đăng nhập
     public function showLoginForm()
     {
         return view('auth.login');
     }
 
     // Phương thức hiển thị form đăng ký
     public function showRegistrationForm()
     {
         return view('auth.register');
     }
}

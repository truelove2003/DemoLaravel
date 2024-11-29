<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
   
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
                        ->with('details.product') // Eager load để lấy chi tiết đơn hàng cùng với sản phẩm
                        ->get();
        
        // Debug dữ liệu để kiểm tra
        dd($orders);

        return view('User.donhang', ['orders' => $orders]);
    }
}

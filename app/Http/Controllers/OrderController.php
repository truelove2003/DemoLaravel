<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Phương thức tạo đơn hàng
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
        ]);
    
        $userId = auth()->id();
        $items = $request->input('items');
    
        // Tính tổng tiền
        $totalAmount = 0;
        foreach ($items as $item) {
            $product = Product::find($item['id']);
            $totalAmount += $product->price * $item['quantity'];
        }
    
        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $totalAmount,
        ]);
    
        // Thêm các sản phẩm vào đơn hàng
        foreach ($items as $item) {
            $product = Product::find($item['id']);
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'total_amount' => $product->price * $item['quantity'],
                'status' => 'pending',
            ]);
        }
    
        // Flash a success message to the session
        session()->flash('success', 'Order created successfully');
    
        // Redirect to the order summary page
        return redirect()->route('user.donhang', ['order' => $order->id]);
    }
    
    


    public function showOrders()
{
    $user = Auth::user();
    $orders = Order::where('user_id', $user->id)
                    ->with('details.product') // Bao gồm quan hệ details và product
                    ->get();
    
    return view('user.donhang', compact('orders'));
}

    public function createOrder(Request $request)
    {
        // Lưu thông tin đơn hàng vào bảng orders
        $order = Order::create([
            'user_id' => Auth::id(),
            // các trường khác của đơn hàng
        ]);

        // Lưu chi tiết đơn hàng vào bảng order_details
        $orderDetail = OrderDetail::create([
            'order_id' => $order->id,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
        ]);

        return redirect()->route('user.donhang');
    }
    

}

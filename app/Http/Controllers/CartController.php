<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Thêm dòng này
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;

use App\Models\CartItem;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    // Xác thực dữ liệu
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::find($request->product_id);
    $user = Auth::user();
    
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }
    
    // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
    $cartItem = Cart::where('user_id', $user->id)
                     ->where('product_id', $product->id)
                     ->first();

    if ($cartItem) {
        // Nếu sản phẩm đã có trong giỏ hàng, không cập nhật số lượng
        return redirect()->back()->with('error', 'Product already in cart.');
    }

    // Thêm sản phẩm vào giỏ hàng
    Cart::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'product_name' => $product->name,
        'image' => $product->image,
        'quantity' => $request->quantity,
    ]);

    // Chuyển hướng đến trang sản phẩm hiện tại với thông báo thành công
    return redirect()->back()->with('message', 'Product added to cart!');
}

    
    
public function index()
{
    
    $user = Auth::user();
    $cartItems = Cart::where('user_id', $user->id)
                     ->with('product') // Ensure product relationship is loaded
                     ->get();

    return view('user.order', compact('cartItems'));
}
public function remove(Request $request)
{
    // Xác thực người dùng
    $user = Auth::user();
    
    // Tìm mục giỏ hàng cần xóa
    $cartItem = Cart::where('user_id', $user->id)
                    ->where('id', $request->id)
                    ->first();

    if ($cartItem) {
        // Xóa mục khỏi giỏ hàng
        $cartItem->delete();
        return response()->json(['message' => 'Item removed from cart!']);
    }

    // Trường hợp không tìm thấy mục giỏ hàng
    return response()->json(['error' => 'Item not found in cart.'], 404);
}

public function update(Request $request)
{
    $user = Auth::user();
    $cartItem = Cart::where('user_id', $user->id)
                    ->where('id', $request->id)
                    ->first();

    if ($cartItem) {
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}
public function total()
{
    $userId = auth()->id();
    $cartItems = CartItem::where('user_id', $userId)->get();

    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item->product->price * $item->quantity;
    }

    return response()->json(['total' => $total], 200);
}



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
class ProductController extends Controller
{
    // Display a listing of the products.
  
public function index1()
{
    $products = Product::all();
    return view('admin1.table-product',compact('products'));    
}
    // Show the form for creating a new product.
   
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
            'color' => 'required|string',
        ]);
    
        // Create a new product
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id'); // Set category_id
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('public/images');
        }
        $product->color = $request->input('color');
        $product->save();
    
        return redirect()->route('products.index1')->with('success', 'Product created successfully!');
    }
    public function create()
{
    $categories=Category::all(); // Lấy tất cả danh mục
    return view('admin1.create-product', compact('categories'));
}


public function edit($id)
{
    $product = Product::find($id);
    $categories = Category::all(); // Lấy tất cả danh mục
    return view('admin1.edit-product', compact('product', 'categories'));
}
public function update(Request $request, $id)
{
    // Validate dữ liệu từ form
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'color' => 'required|string|max:50',
    ]);

    // Tìm sản phẩm theo ID
    $product = Product::findOrFail($id);

    // Cập nhật thông tin sản phẩm
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->stock = $request->input('stock');
    $product->category_id = $request->input('category_id');
    $product->color = $request->input('color');

    // Xử lý hình ảnh (nếu có)
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $product->image = $imagePath;
    }

    $product->save(); // Lưu thay đổi

    return redirect()->route('products.index1')->with('success', 'Product updated successfully!');
}
public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index1')->with('success', 'Product deleted successfully!');
}
public function addImages(Request $request, $productId)
{
    // Validate the request
    $request->validate([
        'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Find the product
    $product = Product::find($productId);

    if ($product) {
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                // Store the image and get the path
                $imagePath = $image->store('products', 'public');

                // Create a new record in the ProductImage table
                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                ]);
            }

            return redirect()->back()->with('success', 'Product updated successfully!');
        } else {
            return redirect()->back()->with('error', 'No images were uploaded!');
        }
    } else {
        return redirect()->back()->with('error', 'Product not found!');
    }
}


public function showImages($productId)
{
    // Tìm sản phẩm theo ID
    $product = Product::findOrFail($productId);

    // Truyền dữ liệu vào view để hiển thị ảnh của sản phẩm
    $images = $product->images; // Hoặc sử dụng phương thức tương ứng để lấy ảnh

    return view('admin1.addimg', compact('product', 'images'));
}
public function show($id)
{
    $product = Product::with('images')->findOrFail($id);
    return view('user.show', compact('product'));
}

    public function checkout(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        // Xử lý logic mua hàng tại đây

        return view('checkout', compact('product', 'quantity'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('s');
        $products = Product::where('name', 'like', '%' . $searchTerm . '%')->get();

        return view('user.show', compact('products'));
    }
}
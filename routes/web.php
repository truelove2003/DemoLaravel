<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Order;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return view('admin1.admin');
});
Route::get('/create-product', function () {
    return view('admin1.create-product');
});
Route::get('/form-category', function () {
    return view('admin1.form-category');
});
Route::get('/table-category', function () {
    return view('admin1.table_category');
});
Route::get('/table-contact', function () {
    return view('admin1.table-contact');
});
Route::get('/table-product', function () {
    return view('admin1.product');
});
Route::get('/', function(){
    return view('welcome');
});
use App\Http\Controllers\RegisterController;

Route::get('/register', function () {
    return view('register');
})->name('register.form');

Route::post('/register', [RegisterController::class, 'store'])->name('register');

use App\Http\Controllers\Auth\LoginController;

// Hiển thị form đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Xử lý đăng nhập
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Xử lý đăng xuất
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//CATEGORY
use App\Http\Controllers\CategoryController;
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'insert'])->name('categories.insert');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
//update
Route::patch('/categories/{category}', 'CategoryController@update')->name('categories.update');
Route::delete('/categories/{id}', 'App\Http\Controllers\CategoryController@delete')->name('categories.destroy');
Route::get('/table-category', function () {
    $categories = Category::all(); // or whatever logic to fetch categories
    return view('admin1.table_category', compact('categories'));
})->name('categories.index');

//PRODUCT
use App\Http\Controllers\ProductController;
// Route để hiển thị danh sách sản phẩm
Route::get('/table-product', function () {
    $products = Product::all(); // or whatever logic to fetch categories
    return view('admin1.product', compact('products'));
})->name('products.index1');
// Route để hiển thị form tạo sản phẩm mới
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route để lưu sản phẩm mới
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route để hiển thị form chỉnh sửa sản phẩm
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route để cập nhật sản phẩm
Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update');
// Route để xóa sản phẩm
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
// Route để hiển thị form thêm ảnh
Route::get('/products/{productId}/add-images', [ProductController::class, 'showImages'])->name('products.showImages');

// Route để thêm ảnh
Route::post('/products/{productId}/images', [ProductController::class, 'addImages'])->name('products.addImages');

use App\Http\Controllers\User\ContactController;


// Route để hiển thị danh sách tất cả các liên hệ
Route::get('/table-contact', [ContactController::class, 'index'])->name('contacts.index');

// Route để hiển thị form liên hệ
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');

// Route để xử lý dữ liệu từ form liên hệ
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/user', function () {
    return view('User.index');
});

use App\Http\Controllers\UserProductController;

Route::get('/user/products', [UserProductController::class, 'index'])->name('user.products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
////////////////////them vao gio hang
use App\Http\Controllers\CartController;
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    
});

Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/total', [CartController::class, 'total'])->name('cart.total');

use App\Http\Controllers\OrderController;

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');

use App\Http\Controllers\UserOrderController;

Route::get('/donhang', [OrderController::class, 'showOrders'])->name('user.donhang');

// routes/web.php
use App\Http\Controllers\OrderDetailController;
Route::get('/order-details', [OrderDetailController::class, 'index'])->name('orderDetails.index');
Route::get('/order-details/{id}/edit', [OrderDetailController::class, 'edit'])->name('orderDetails.edit');
Route::put('/order-details/{id}', [OrderDetailController::class, 'update'])->name('orderDetails.update');
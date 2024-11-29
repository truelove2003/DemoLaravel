<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('User.product', compact('products'));
    }
}

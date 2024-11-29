<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return view('admin1.order_details', compact('orderDetails'));
    }
    public function edit($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return view('admin1.edit-details', compact('orderDetail'));
    }

    // Method to update the status of a specific order detail
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->update($validatedData);

        return redirect()->route('orderDetails.index')->with('success', 'Order Detail status updated successfully');
    }
}

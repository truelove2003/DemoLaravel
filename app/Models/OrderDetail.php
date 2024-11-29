<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $table = 'order_details';

    // Các thuộc tính có thể gán hàng loạt
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total_amount',
        'status'
    ];

    // Định nghĩa quan hệ với bảng `Order`
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Định nghĩa quan hệ với bảng `Product`
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}

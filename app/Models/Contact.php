<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    // Nếu tên bảng không theo quy tắc đặt tên mặc định của Laravel
    protected $table = 'contacts';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];

    // Nếu bạn muốn sử dụng timestamps (created_at và updated_at)
    public $timestamps = true;
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // Tạo cột id tự tăng
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Khóa ngoại đến bảng orders
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại đến bảng products
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->decimal('total_amount', 10, 2); // Tổng tiền cho sản phẩm
            $table->string('status'); // Trạng thái của chi tiết đơn hàng
            $table->timestamps(); // Cột created_at và updated_at
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};

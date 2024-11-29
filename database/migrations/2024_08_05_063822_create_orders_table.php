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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID của đơn hàng
            $table->unsignedBigInteger('user_id'); // ID của người mua (người dùng)
            $table->decimal('total_amount', 10, 2); // Tổng thành tiền của đơn hàng
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

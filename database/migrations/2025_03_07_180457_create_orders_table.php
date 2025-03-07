<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Liên kết với bảng users
            $table->decimal('total_price', 10, 2)->default(0); // Tổng tiền đơn hàng
            $table->enum('status', ['pending', 'processing', 'completed', 'canceled'])->default('pending'); // Trạng thái đơn hàng
            $table->timestamps(); // Ngày tạo và cập nhật
    
            // Khóa ngoại liên kết với users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->string('order_code')->unique();
            $table->decimal('total_amount', 15, 2);
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->string('status')->default('Đang xử lý');
            $table->timestamps();
    
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('set null');
        });
    }
};

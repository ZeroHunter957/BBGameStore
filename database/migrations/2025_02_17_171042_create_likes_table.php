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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('comment_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('reply_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('blog_id')->nullable()->constrained()->onDelete('cascade'); // If you want to allow likes on the blog itself
            $table->timestamps();
    
            $table->unique(['user_id', 'comment_id']); // Prevent multiple likes by same user on the same comment
            $table->unique(['user_id', 'reply_id']);   // Prevent multiple likes by same user on the same reply
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
};

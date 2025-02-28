<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cat_id");
            // cat_id referencing id in game_categories
            $table->foreign("cat_id")
            ->references("id")->on("game_categories")
            ->onDelete("cascade");
            $table->string(column: "title");
            $table->decimal(column: "price", total: 10, places:2);
            $table->text("description");
            $table->boolean('todays_pick')->default(0)->change();
            $table->string("developer");
            $table->string("platform");
            $table->date("release_date");
            $table->string("image");
            $table->binary("file");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');

        Schema::table('games', function (Blueprint $table) {
            $table->boolean('todays_pick')->change();
        });
    }
};
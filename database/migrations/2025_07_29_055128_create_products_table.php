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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sub_category_id')->nullable();

            // Define foreign key constraint
            $table->foreign('sub_category_id')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade');

            $table->string('product_name');
            $table->json('images')->nullable(); // multiple images
            $table->string('sizes')->nullable(); // comma-separated
            $table->string('colors')->nullable(); // comma-separated
            $table->string('actual_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->string('size_chart_image')->nullable(); // single image
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

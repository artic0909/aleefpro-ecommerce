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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Foreign key to customers table
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->onDelete('cascade');

            // Product details in JSON
            $table->json('product_details')->comment('product_name, product_code, product_color, product_rate, product_size, product_quantity, total_amount');

            // Overall order amount
            $table->decimal('overall_amount', 10, 2);

            // Payment details
            $table->string('payment_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10)->default('USD');
            $table->string('payment_status', 50)->default('pending');
            $table->date('order_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

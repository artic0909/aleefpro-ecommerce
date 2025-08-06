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
        Schema::create('product_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_code');
            $table->string('price');
            $table->string('main_sub_category');
            $table->string('colors');
            $table->string('sizes');
            $table->string('units');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_mobile');
            $table->text('customer_address');
            $table->text('detail_enquiry');
            $table->date('enquiry_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_enquiries');
    }
};

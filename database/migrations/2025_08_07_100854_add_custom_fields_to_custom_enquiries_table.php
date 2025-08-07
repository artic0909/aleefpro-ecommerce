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
        Schema::table('custom_enquiries', function (Blueprint $table) {
            $table->string('font_name')->nullable();
            $table->string('company_text_logo')->nullable();
            $table->string('company_text_color_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_enquiries', function (Blueprint $table) {
            $table->dropColumn(['font_name', 'company_text_logo', 'company_text_color_code']);
        });
    }
};

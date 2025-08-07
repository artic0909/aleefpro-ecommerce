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
            $table->string('logo_size')->nullable()->after('logo_placement');
            $table->string('print_quality')->nullable()->after('logo_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_enquiries', function (Blueprint $table) {
            $table->dropColumn(['logo_size', 'print_quality']);
        });
    }
};

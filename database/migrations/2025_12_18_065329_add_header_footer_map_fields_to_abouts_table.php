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
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('header_logo')->nullable()->after('id');
            $table->string('footer_logo')->nullable()->after('header_logo');
            $table->text('map_iframe_view')->nullable()->after('footer_logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'header_logo',
                'footer_logo',
                'map_iframe_view'
            ]);
        });
    }
};

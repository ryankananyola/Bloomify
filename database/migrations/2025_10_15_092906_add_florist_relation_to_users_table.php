<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Jika tabel florists sudah ada, tambahkan relasi foreign key
            $table->foreign('florists_id')->references('id')->on('florists')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['florists_id']);
            $table->dropColumn(['florists_id']);
        });
    }
};

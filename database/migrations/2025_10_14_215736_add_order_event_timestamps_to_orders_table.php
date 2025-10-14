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
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('paid_at')->nullable()->after('payment_status');
            $table->timestamp('prepared_at')->nullable()->after('paid_at');   // bunga dibuat
            $table->timestamp('shipped_at')->nullable()->after('prepared_at'); // bunga dikirim
            $table->timestamp('delivered_at')->nullable()->after('shipped_at');// sampai / selesai
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['paid_at','prepared_at','shipped_at','delivered_at']);
        });
    }

};

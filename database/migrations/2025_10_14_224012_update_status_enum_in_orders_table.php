<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum status pada tabel orders
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM(
            'Pending',
            'Confirmed',
            'Processing',
            'Ready to Ship',
            'Out for Delivery',
            'Delivered',
            'Cancelled'
        ) DEFAULT 'Pending'");
    }

    public function down(): void
    {
        // Balik ke versi lama kalau rollback
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM(
            'Pending',
            'Confirmed',
            'Processing',
            'Out for Delivery',
            'Delivered',
            'Cancelled'
        ) DEFAULT 'Pending'");
    }
};

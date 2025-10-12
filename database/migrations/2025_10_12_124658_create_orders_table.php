<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('florist_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('address')->nullable();

            $table->integer('quantity')->default(1);
            $table->enum('pickup_method', ['Pick Up', 'Delivery Go-Send', 'Delivery Florist']);
            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();

            $table->enum('paper_bag', ['Plastic', 'Paper Bag'])->default('Plastic');
            $table->boolean('greeting_card')->default(false);
            $table->text('greeting_message')->nullable();
            $table->text('additional_request')->nullable();

            $table->enum('payment_method', ['Transfer Bank', 'QRIS'])->nullable();
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed'])->default('Pending');
            $table->decimal('total_price', 12, 2)->default(0);

            $table->enum('status', [
                'Pending',
                'Confirmed',
                'Being Prepared',
                'Out for Delivery',
                'Delivered',
                'Cancelled'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

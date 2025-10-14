<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Products;
use App\Models\User;
use App\Models\Florist;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'florist_id',
        'product_id',
        'customer_name',
        'customer_phone',
        'quantity',
        'pickup_method',
        'pickup_date',
        'pickup_time',
        'address',
        'paper_bag',
        'greeting_card',
        'greeting_message',
        'additional_request',
        'payment_method',
        'sender_name',
        'payment_proof',
        'payment_status',
        'paid_at',
        'prepared_at',
        'ready_at',
        'shipped_at',
        'delivered_at',
        'order_code',
        'total_price',
        'status',
        'slug',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function florist()
    {
        return $this->belongsTo(Florist::class, 'florist_id');
    }

    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp' . number_format($this->total_price, 0, ',', '.');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $product = $order->product ?? Products::find($order->product_id);
            $baseSlug = $product ? Str::slug($product->name) : 'order';

            $count = Order::where('slug', 'like', "{$baseSlug}%")->count();
            $order->slug = $count > 0 ? "{$baseSlug}-{$count}" : $baseSlug;
        });
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->order_code = 'BLOOMY' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        });

         static::updating(function ($order) {
            if ($order->isDirty('status')) {
                switch ($order->status) {
                    case 'Confirmed':
                        $order->paid_at = $order->paid_at ?? now();
                        break;
                    case 'Processing':
                        $order->prepared_at = $order->prepared_at ?? now();
                        break;
                    case 'Ready to Ship':
                        $order->ready_at = $order->ready_at ?? now();
                        break;
                    case 'Out for Delivery':
                        $order->shipped_at = $order->shipped_at ?? now();
                        break;
                    case 'Delivered':
                        $order->delivered_at = $order->delivered_at ?? now();
                        break;
                }
            }
        });
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ]; 

    public static $statusSteps = [
        'Confirmed' => 'Verifikasi Pesanan',
        'Processing' => 'Bunga Dibuat',
        'Ready to Ship' => 'Bunga Siap Dikirim',
        'Out for Delivery' => 'Bunga Dalam Pengiriman',
        'Delivered' => 'Pesanan Selesai',
    ];

    

}

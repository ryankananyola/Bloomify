<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'total_price',
        'status',
        'slug', 
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
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
            if ($order->product) {
                $baseSlug = Str::slug($order->product->name);
            } else {
                $product = Products::find($order->product_id);
                $baseSlug = $product ? Str::slug($product->name) : 'order';
            }

            $count = Order::where('slug', 'like', "{$baseSlug}%")->count();
            $order->slug = $count > 0 ? "{$baseSlug}-{$count}" : $baseSlug;
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Products;
use Illuminate\Support\Str;

class Florist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'image',
        'open_time',
        'close_time',
        'start_price',
        'rating',
    ];

    public function getStatusAttribute()
    {
        $now = Carbon::now('Asia/Jakarta');
        $open = Carbon::parse($this->open_time, 'Asia/Jakarta');
        $close = Carbon::parse($this->close_time, 'Asia/Jakarta');

        if ($now->between($open, $close)) {
            return 'open';
        }

        return 'close';
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->start_price, 0, ',', '.');
    }

    public function getOpenTimeFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->open_time)->format('H:i');
    }

    public function getCloseTimeFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->close_time)->format('H:i');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'florists_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($florist) {
            if (empty($florist->slug)) {
                $florist->slug = Str::slug($florist->name);
            }
        });
    }
}

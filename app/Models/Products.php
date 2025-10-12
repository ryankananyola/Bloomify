<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'florists_id',
        'name',
        'description',
        'price',
        'flowers',
        'image',
    ];

    protected $casts = [
        'flowers' => 'array',
    ];

    public function florist()
    {
        return $this->belongsTo(\App\Models\Florist::class, 'florists_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

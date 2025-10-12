<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

}

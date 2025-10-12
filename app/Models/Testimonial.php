<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'florist_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function florist()
    {
        return $this->belongsTo(\App\Models\Florist::class, 'florist_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}

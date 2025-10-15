<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'password',
        'role',        
        'florist_id',  
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function florist()
    {
        return $this->belongsTo(Florist::class, 'florists_id');
    }


    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

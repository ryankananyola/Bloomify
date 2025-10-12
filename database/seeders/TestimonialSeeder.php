<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'florist_id' => 3,
            'user_id' => 1,
            'rating' => 5,
            'comment' => 'Pelayanannya cepat dan bouquet-nya super cantik! Bunga segar dan tahan lama 🌷',
        ]);

        Testimonial::create([
            'florist_id' => 3,
            'user_id' => 6,
            'rating' => 4,
            'comment' => 'Desain bunga sangat elegan, tapi pengiriman agak telat sedikit. Overall puas banget 💐',
        ]);

        Testimonial::create([
            'florist_id' => 3,
            'user_id' => 5,
            'rating' => 5,
            'comment' => 'Pesanan untuk acara lamaran, hasilnya luar biasa indah! Terima kasih tim Bloomify 💞',
        ]);
    }
}

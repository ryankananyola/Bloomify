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
            'florist_id' => 1,
            'user_id' => 5,
            'rating' => 5,
            'comment' => 'Bunga ulang tahun yang saya pesan sangat memukau! Kualitasnya top dan pengirimannya tepat waktu 🎉',
        ]);

        Testimonial::create([
            'florist_id' => 2,
            'user_id' => 6,
            'rating' => 4,
            'comment' => 'Sangat membantu untuk acara pernikahan saya. Bunga-bunganya segar dan cantik, hanya saja ada sedikit kesalahan di alamat pengiriman. Tapi tetap puas! 👰🤵'
        ]);

        Testimonial::create([
            'florist_id' => 3,
            'user_id' => 1,
            'rating' => 5,
            'comment' => 'Layanan pelanggan yang luar biasa! Mereka membantu saya memilih bunga yang sempurna untuk hari jadi kami. Terima kasih banyak! 💐❤️',
        ]);

        Testimonial::create([
            'florist_id' => 7,
            'user_id' => 1,
            'rating' => 3,
            'comment' => 'Bunga yang saya terima cukup bagus, tapi ada beberapa kelopak yang sedikit layu. Mungkin karena pengiriman yang lama. Namun, secara keseluruhan saya puas dengan layanan mereka. 🌸',
        ]);

        Testimonial::create([
            'florist_id' => 8,
            'user_id' => 5,
            'rating' => 5,
            'comment' => 'Pengalaman belanja yang menyenangkan! Situs web mereka mudah digunakan dan proses pemesanan sangat lancar. Bunga yang saya pesan tiba dalam kondisi sempurna. Terima kasih! 🌷😊',
        ]);

        Testimonial::create([
            'florist_id' => 12,
            'user_id' => 6,
            'rating' => 4,
            'comment' => 'Bunga yang saya pesan untuk acara kantor sangat memukau! Semua orang memuji keindahannya. Hanya saja, pengiriman sedikit terlambat. Tapi tetap puas dengan kualitasnya. 🌹🏢',
        ]);
    }
}

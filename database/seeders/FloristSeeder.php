<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Florist;

class FloristSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Florist::insert([
            [
                'name' => 'Kaninara Florist',
                'address' => 'Jl. Kaliurang No.Km 13, Besi, Sardonoharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/kaninara.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 10000,
                'rating' => 4.8,
            ],
            [
                'name' => 'Ren Florist Co.',
                'address' => 'Jl. Cenderawasih No.3, Mrican, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/renflorist.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 15000,
                'rating' => 4.8,
            ],
            [
                'name' => 'Kaning Bouquet and Gift Florist',
                'address' => 'Jl. Gambir No.1, Karangasem, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/kaning.png',
                'open_time' => '08:00',
                'close_time' => '20:00',
                'start_price' => 8000,
                'rating' => 4.9,
            ],
            [
                'name' => 'Beverly Florist Jogja',
                'address' => 'Karang Gayam, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/beverly.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 8000,
                'rating' => 4.9,
            ],
            [
                'name' => 'Halia Florist',
                'address' => 'Jl. Gambir Karangasem Baru, Karang Gayam, Caturtunggal, Kec. Depok, Kabupaten Sleman, Yogyakarta, Daerah Istimewa Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/beverly.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 15000,
                'rating' => 4.8,
            ],
            [
                'name' => 'Lupy Florist',
                'address' => 'Jl. Flamboyan No.34D, Karang Gayam, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/lupy.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 12000,
                'rating' => 4.5,
            ],
            [
                'name' => 'Jardinelle Florist',
                'address' => 'Karang Gayam, Caturtunggal, Depok, Sleman, Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/jardinelle.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 20000,
                'rating' => 4.7,
            ],
            [
                'name' => 'Florya Florist',
                'address' => 'Jl. Gambir Baru, Karangasem, Karang Gayam, Sleman, Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/florya.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 15000,
                'rating' => 4.8,
            ],
            [
                'name' => 'La Rosée Florist',
                'address' => 'Jl. Flamboyan No. 34D, Karang Gayam, Depok, Sleman, Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/larosee.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 12000,
                'rating' => 4.8,
            ],
            [
                'name' => 'Belle Flora',
                'address' => 'Karang Gayam, Caturtunggal, Depok, Sleman, Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/belle.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 20000,
                'rating' => 4.6,
            ],
            [
                'name' => 'Mira Florist',
                'address' => 'Jl. Gambir Baru, Karangasem, Karang Gayam, Sleman, Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/mira.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 15000,
                'rating' => 4.4,
            ],
            [
                'name' => 'Lovenique Florist',
                'address' => 'Jl. Flamboyan No. 34D, Karang Gayam, Depok, Sleman, Yogyakarta',
                'city' => 'Yogyakarta',
                'image' => 'uploads/florists/lovenique.png',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'start_price' => 12000,
                'rating' => 4.8,
            ]
        ]);
    }
}

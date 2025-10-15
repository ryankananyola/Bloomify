<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Florist;

class FloristUserSeeder extends Seeder
{
    public function run(): void
    {
        $florists = Florist::all();
        $counter = 1;

        foreach ($florists as $florist) {
            User::create([
                'full_name' => "{$florist->name} Owner",
                'email' => strtolower(str_replace(' ', '', $florist->name)) . '-florist@bloomify.com',
                'phone_number' => '0812345678' . str_pad($counter, 2, '0', STR_PAD_LEFT),
                'password' => Hash::make(explode(' ', strtolower($florist->name))[0] . '123'),
                'role' => 'florist',
                'florists_id' => $florist->id,
            ]);

            $counter++;
        }
    }
}

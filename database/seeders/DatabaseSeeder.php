<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\EstateAttachment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Jalankan UserFactory eksplisit untuk buat Akun Testing Utama
        $mainAgent = User::factory()->create([
            'name' => 'Agen Properti Utama',
            'email' => 'agen@downloadrumah.com',
            'phone_number' => '6281234567890',
            // 'password' => bcrypt('password'),
            'password' => '1sampai3',

        ]);

        // 2. Jalankan UserFactory eksplisit untuk buat 3 Agen Dummy Tambahan
        $otherAgents = User::factory(3)->create();

        // 3. Buat Listing Properti untuk Agen Utama
        Estate::factory(10)->create([
            'user_id' => $mainAgent->id,
        ])->each(function ($estate) {
            EstateAttachment::factory()->create([
                'estate_id' => $estate->id,
                'is_primary' => true,
                'sort_order' => 0,
            ]);

            EstateAttachment::factory(2)->create([
                'estate_id' => $estate->id,
                'is_primary' => false,
            ]);
        });

        // 4. Buat Listing Properti untuk Agen-Agen Lainnya
        foreach ($otherAgents as $agent) {
            Estate::factory(3)->create([
                'user_id' => $agent->id,
            ])->each(function ($estate) {
                EstateAttachment::factory()->create([
                    'estate_id' => $estate->id,
                    'is_primary' => true,
                ]);
            });
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvincesSeeder extends Seeder
{
    public function run(): void
    {
        // Pakai forward slash '/' agar cross-platform
        $jsonPath = database_path('seeders/data/provinces.json');

        // Pastikan file-nya ada sebelum diproses
        if (!File::exists($jsonPath)) {
            $this->command->error("File tidak ditemukan di: {$jsonPath}");
            return;
        }

        $json = File::get($jsonPath);
        $provinces = json_decode($json, true);

        // manipulasi data menjadi 100+ di idnya
        $startId = 100;

        foreach ($provinces as $index => $province) {

            $customId = $startId + $index;
            Province::firstOrCreate(
                ['id' => $customId],
                [
                    'nama' => $province['nama'],
                    'latitude' => $province['latitude'] ?? 0,
                    'longitude' => $province['longitude'] ?? 0,
                ]
            );
        }
    }
}

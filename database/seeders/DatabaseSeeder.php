<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\EstateAttachment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Wilayah Indonesia
        $this->call([
            ProvincesSeeder::class,
            CitiesSeeder::class,
        ]);

        // 2. Akun Testing Utama
        $mainAgent = User::factory()->create([
            'name'         => 'Agen Properti Utama',
            'email'        => 'a@a.com',
            'phone_number' => '6281234567890',
            'password'     => '123',
        ]);

        // 3. Listing Properti Agen Utama (+ Attachments)
        $this->createEstatesWithAttachments($mainAgent, count: 10, galleryCount: 2);

        // 4. Agen Dummy Tambahan & Listing-nya
        User::factory(3)->create()->each(function (User $agent) {
            $this->createEstatesWithAttachments($agent, count: 3, galleryCount: 0);
        });
    }

    /**
     *
     * Helper privat untuk isolasi logic pembuatan Estate & Attachment
     */
    private function createEstatesWithAttachments(User $user, int $count, int $galleryCount = 0): void
    {
        Estate::factory($count)
            ->create(['user_id' => $user->id])
            ->each(function (Estate $estate) use ($galleryCount) {
                // Primary Attachment
                EstateAttachment::factory()->create([
                    'estate_id'  => $estate->id,
                    'is_primary' => true,
                    'sort_order' => 0,
                ]);

                // Additional Gallery Attachments
                if ($galleryCount > 0) {
                    EstateAttachment::factory($galleryCount)->create([
                        'estate_id'  => $estate->id,
                        'is_primary' => false,
                    ]);
                }
            });
    }
}

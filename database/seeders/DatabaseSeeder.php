<?php

/**
 * <meta_config>
 * @path : database/seeders/DatabaseSeeder.php | usage: Main Orchestrator Seeder
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\EstateAttachment;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * Step 1: Seed Wilayah Indonesia & Master Fasilitas
         */
        $this->call([
            ProvincesSeeder::class,
            CitiesSeeder::class,
            FacilitySeeder::class,
        ]);

        /**
         * Step 2: Akun Testing Utama (Safe First-or-Create)
         */
        $mainAgent = User::firstOrCreate(
            ['email' => 'a@a.com'],
            [
                'name' => 'Agen Properti Utama',
                'phone_number' => '6281234567890',
                'password' => bcrypt('123'),
            ]
        );

        $adminAgent = User::firstOrCreate(
            ['email' => 'eayogawilanda@gmail.com'],
            [
                'name' => 'Yoga Wilanda',
                'phone_number' => '6281258986696',
                'password' => bcrypt('hellovoid'),
            ]
        );

        /**
         * Step 3: Listing Properti Agen Utama (+ Attachments & Facilities)
         */
        $this->createEstatesWithAttachments($mainAgent, count: 10, galleryCount: 2);

        /**
         * Step 4: Agen Dummy Tambahan & Listing-nya
         */
        User::factory(3)->create()->each(function (User $agent) {
            $this->createEstatesWithAttachments($agent, count: 3, galleryCount: 0);
        });
    }

    /**
     * Helper privat untuk isolasi logic pembuatan Estate, Attachment, & Pivot Facility
     */
    private function createEstatesWithAttachments(User $user, int $count, int $galleryCount = 0): void
    {
        $facilities = Facility::all();

        Estate::factory($count)
            ->create(['user_id' => $user->id])
            ->each(function (Estate $estate) use ($galleryCount, $facilities) {
                // Attach random facilities ke pivot table
                if ($facilities->isNotEmpty()) {
                    $randomFacilities = $facilities->random(rand(2, 5));
                    foreach ($randomFacilities as $facility) {
                        $estate->facilities()->attach($facility->id, [
                            'value' => $facility->category === 'utility' ? '2200 Watt' : null,
                        ]);
                    }
                }

                // Primary Attachment
                EstateAttachment::factory()->create([
                    'estate_id' => $estate->id,
                    'is_primary' => true,
                    'sort_order' => 0,
                ]);

                // Additional Gallery Attachments
                if ($galleryCount > 0) {
                    EstateAttachment::factory($galleryCount)->create([
                        'estate_id' => $estate->id,
                        'is_primary' => false,
                    ]);
                }
            });
    }
}

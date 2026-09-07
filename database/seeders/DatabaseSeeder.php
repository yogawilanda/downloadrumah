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
use Illuminate\Support\Facades\App;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * Step 1: Seed Master Data & System Config (Required in Production)
         */
        $this->call([
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            FacilitySeeder::class,
            SettingsSeeder::class,
        ]);

        /**
         * Step 2: Seed Dummy Data & Test Accounts (Local / Staging Only)
         */
        if (App::environment(['local', 'staging', 'testing'])) {
            $mainAgent = User::firstOrCreate(
                ['email' => 'eayogawilanda@gmail.com'],
                User::factory()->raw([
                    'name' => 'Yoga Wilanda',
                    'phone_number' => '6281258986696',
                    'is_super_admin' => true,
                ])
            );

            // Listing Properti Agen Utama (+ Attachments & Facilities)
            $this->createEstatesWithAttachments($mainAgent, count: 10, galleryCount: 2);

            // Agen Dummy Tambahan & Listing-nya
            User::factory(3)->create()->each(function (User $agent) {
                $this->createEstatesWithAttachments($agent, count: 3, galleryCount: 0);
            });
        }
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
                    $randomFacilities = $facilities->random(rand(2, min(5, $facilities->count())));
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
                    $estateAttachmentFactory = EstateAttachment::factory($galleryCount);
                    $estateAttachmentFactory->create([
                        'estate_id' => $estate->id,
                        'is_primary' => false,
                    ]);
                }
            });
    }
}

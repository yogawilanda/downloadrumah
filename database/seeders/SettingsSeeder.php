<?php

/**
 * <meta_config>
 * @path : database/seeders/SettingsSeeder.php | usage: Bootstrap default runtime settings
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * @author : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // Throttle limits
            ['key' => 'throttle.home_feed',           'value' => '60',   'type' => 'integer', 'group' => 'throttle', 'label' => 'Throttle Home Feed',                'description' => 'Max request per minute to home feed (/).',  'options' => null, 'is_public' => true],
            ['key' => 'throttle.storage',             'value' => '120',  'type' => 'integer', 'group' => 'throttle', 'label' => 'Throttle Storage Route',            'description' => 'Max request per minute to /storage/{path}.',  'options' => null, 'is_public' => true],

            // Upload limits
            ['key' => 'max_photos_per_listing',       'value' => '8',    'type' => 'integer', 'group' => 'upload',   'label' => 'Maks Foto per Listing',            'description' => 'Jumlah maksimum foto yang boleh diunggah per listing.', 'options' => null, 'is_public' => true],
            ['key' => 'max_photo_size_kb',            'value' => '3072', 'type' => 'integer', 'group' => 'upload',   'label' => 'Ukuran Maks Foto (KB)',            'description' => 'Ukuran maksimum satu foto dalam kilobyte.', 'options' => null, 'is_public' => true],

            // Feature flags
            ['key' => 'enable_registration',          'value' => '1',    'type' => 'boolean', 'group' => 'feature',  'label' => 'Aktifkan Registrasi',              'description' => 'Aktifkan/nonaktifkan pendaftaran user baru.', 'options' => null, 'is_public' => true],
            ['key' => 'maintenance_mode',             'value' => '0',    'type' => 'boolean', 'group' => 'feature',  'label' => 'Mode Maintenance',                 'description' => 'Tampilkan halaman maintenance ke publik.', 'options' => null, 'is_public' => true],

            // Listing lifecycle
            ['key' => 'auto_archive_days',            'value' => '90',   'type' => 'integer', 'group' => 'listing',  'label' => 'Auto-Arsip (hari)',                'description' => 'Listing otomatis diarsipkan setelah N hari tidak diperbarui. 0 = nonaktif.', 'options' => null, 'is_public' => false],
        ];

        foreach ($defaults as $row) {
            Setting::updateOrCreate(['key' => $row['key']], $row);
        }
    }
}

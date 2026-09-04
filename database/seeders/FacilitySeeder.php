<?php

/**
 * <meta_config>
 * @path : database/seeders/FacilitySeeder.php | usage: Master Facilities Seeder
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['name' => 'AC', 'category' => 'general', 'icon' => 'ph-snowflake'],
            ['name' => 'Kolam Renang', 'category' => 'general', 'icon' => 'ph-swimming-pool'],
            ['name' => 'Carport', 'category' => 'general', 'icon' => 'ph-car'],
            ['name' => 'Garasi', 'category' => 'general', 'icon' => 'ph-warehouse'],
            ['name' => 'Canopy', 'category' => 'general', 'icon' => 'ph-house-line'],
            ['name' => 'Taman', 'category' => 'general', 'icon' => 'ph-tree'],
            ['name' => 'Daya Listrik', 'category' => 'utility', 'icon' => 'ph-lightning'],
            ['name' => 'Air PDAM', 'category' => 'utility', 'icon' => 'ph-drop'],
            ['name' => 'Sumur Bor', 'category' => 'utility', 'icon' => 'ph-waves'],
            ['name' => 'Keamanan 24 Jam', 'category' => 'security', 'icon' => 'ph-shield-check'],
            ['name' => 'One Gate System', 'category' => 'security', 'icon' => 'ph-door'],
        ];

        foreach ($facilities as $facility) {
            DB::table('facilities')->updateOrInsert(
                ['name' => $facility['name']],
                [
                    'category' => $facility['category'],
                    'icon' => $facility['icon'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

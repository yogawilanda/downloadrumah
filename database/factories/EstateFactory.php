<?php

/**
 * <meta_config>
 * @path : database/factories/EstateFactory.php | usage: Estates Core Model Factory
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace Database\Factories;

use App\Models\Estate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravolt\Indonesia\Models\City;

class EstateFactory extends Factory
{
    protected $model = Estate::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $city = City::inRandomOrder()->first();

        $title = fake()->randomElement([
            'Rumah Minimalis Modern Di Pusat Kota',
            'Villa Mewah View Pegunungan',
            'Ruko 3 Lantai Strategis Pinggir Jalan Utama',
            'Rumah Cluster Asri Siap Huni',
            'Hunian Premium Dekat Akses Tol & Mall',
        ]) . ' ' . ($city ? $city->name : fake()->city());

        return [
            /**
             * Core Identity & Pricing
             */
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'transaction_type' => fake()->randomElement(['sale', 'rent']),
            'property_type' => fake()->randomElement(['house', 'apartment', 'land', 'shophouse', 'villa', 'warehouse', 'office']),
            'price' => fake()->numberBetween(300, 5500) * 1000000,
            'is_kpr' => fake()->boolean(80),
            'certificate_type' => fake()->randomElement(['shm', 'hgb', 'hp', 'girik', 'strata_title']),
            'commission_percentage' => fake()->randomElement([1.00, 2.00, 2.50, 3.00]),
            'listing_group' => fake()->randomElement(['primary', 'secondary']),
            'description' => fake()->paragraph(3),

            /**
             * Regional Location Mapping
             */
            'country' => 'Indonesia',
            'province_id' => $city?->province_code,
            'city_id' => $city?->id,
            'district' => fake()->streetName(),
            'address' => fake()->address(),
            'block_number' => 'Blok ' . fake()->bothify('?#'),
            'map_url' => 'https://maps.google.com/?q=' . fake()->latitude() . ',' . fake()->longitude(),
            'show_map' => true,

            /**
             * Specifications & Physical Features
             */
            'bedroom' => fake()->numberBetween(2, 5),
            'bathroom' => fake()->numberBetween(1, 4),
            'building_size' => fake()->numberBetween(45, 300),
            'land_size' => fake()->numberBetween(60, 400),
            'building_width' => fake()->numberBetween(6, 15),
            'building_length' => fake()->numberBetween(10, 25),
            'floor_count' => fake()->numberBetween(1, 3),
            'garage_capacity' => fake()->numberBetween(1, 2),
            'facing' => fake()->randomElement(['north', 'south', 'east', 'west', 'north_east', 'north_west', 'south_east', 'south_west']),
            'furnish_type' => fake()->randomElement(['unfurnished', 'semi_furnished', 'full_furnished']),

            /**
             * Owner Contacts & Workflow Status
             */
            'owner_phone' => '628' . fake()->numerify('##########'),
            'show_owner_phone' => fake()->boolean(70),
            'status' => 'active',
        ];
    }
}

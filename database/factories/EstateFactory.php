<?php

namespace Database\Factories;

use App\Models\Estate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravolt\Indonesia\Models\City;

class EstateFactory extends Factory
{
    protected $model = Estate::class;

    public function definition(): array
    {
        // Ambil kota acak dari database Laravolt yang sudah di-seed
        $city = City::inRandomOrder()->first();

        $title = fake()->randomElement([
            'Rumah Minimalis Modern Di Pusat Kota',
            'Villa Mewah View Pegunungan',
            'Ruko 3 Lantai Strategis Pinggir Jalan Utama',
            'Rumah Cluster Asri Siap Huni',
            'Hunian Premium Dekat Akses Tol & Mall',
        ]) . ' ' . ($city ? $city->name : fake()->city());

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'transaction_type' => fake()->randomElement(['sale', 'rent']),
            'property_type' => fake()->randomElement(['house', 'apartment', 'land', 'shophouse', 'villa', 'warehouse', 'office']),
            'price' => fake()->numberBetween(300, 5500) * 1000000, // 300 Jt - 5.5 M
            'commission_percentage' => fake()->randomElement([1.00, 2.00, 2.50, 3.00]),
            'listing_group' => fake()->optional(0.3)->randomElement(['Primary', 'Secondary', 'Exclusive']),
            'description' => fake()->paragraph(3),

            // Lokasi Listing (Mapped ke Laravolt)
            'province_id' => $city?->province_code,
            'city_id' => $city?->id,
            'district' => fake()->streetName(),
            'address' => fake()->address(),
            'block_number' => 'Blok ' . fake()->bothify('?#'),
            'show_map' => true,

            // Detail Specs
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

            // Agent Contact
            'agent_phone' => '628' . fake()->numerify('##########'),

            // JSON Attributes (Sesuai Mapped UI / Model Accessor)
            'attributes' => [
                'is_kpr' => fake()->boolean(80),
                'has_imb' => fake()->boolean(90),
                'has_blueprint' => fake()->boolean(70),
                'legal_docs' => fake()->randomElement(['SHM', 'HGB', 'AJB']),
                'promo_cooperation' => fake()->optional(0.6)->randomElement(['Free BPHTB', 'Bonus AC & Canopy', 'DP 0%']),
                'agent_cooperation' => fake()->boolean(50),
                'electricity' => fake()->randomElement(['1300', '2200', '3500', '5500']),
                'water_type' => fake()->randomElement(['PDAM', 'Sumur Bor']),
                'nearest_places' => fake()->randomElements(['Akses Tol', 'Mall', 'Rumah Sakit', 'Stasiun', 'Sekolah'], 2),
                'video_url' => fake()->optional(0.4)->url(),
            ],

            'status' => 'active',
        ];
    }
}

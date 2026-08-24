<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstateFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->randomElement([
            'Rumah Minimalis Modern Di Pusat Kota',
            'Villa Mewah View Pegunungan',
            'Ruko 3 Lantai Strategis Pinggir Jalan Utama',
            'Rumah Cluster Asri Siap Huni',
            'Hunian Premium Dekat Akses Tol & Mall',
        ]) . ' ' . fake()->city();

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'transaction_type' => fake()->randomElement(['sale', 'rent']),
            'price' => fake()->numberBetween(300, 5500) * 1000000, // 300 Jt - 5.5 M
            'city' => fake()->randomElement(['Jakarta Selatan', 'Surabaya', 'Bandung', 'Tangerang Selatan', 'Bekasi']),
            'district' => fake()->streetName(),
            'address' => fake()->address(),
            'bedroom' => fake()->numberBetween(2, 5),
            'bathroom' => fake()->numberBetween(1, 4),
            'building_size' => fake()->numberBetween(45, 300),
            'land_size' => fake()->numberBetween(60, 400),
            'description' => fake()->paragraph(3),
            'attributes' => [
                'certificate' => fake()->randomElement(['SHM', 'HGB', 'AJB']),
                'electricity' => fake()->randomElement([1300, 2200, 3500, 5500]),
                'facing' => fake()->randomElement(['Utara', 'Selatan', 'Timur', 'Barat']),
                'promo' => fake()->optional(0.6)->randomElement(['Free BPHTB', 'Bonus AC & Canopy', 'DP 0%']),
            ],
            'status' => 'active',
        ];
    }
}

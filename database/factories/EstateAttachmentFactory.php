<?php

namespace Database\Factories;

use App\Models\Estate;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstateAttachmentFactory extends Factory
{
    public function definition(): array
    {
        $images = [
            'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
        ];

        return [
            'estate_id' => Estate::factory(),
            'file_path' => fake()->randomElement($images),
            'file_type' => 'image',
            'is_primary' => false,
            'sort_order' => fake()->numberBetween(1, 5),
        ];
    }
}

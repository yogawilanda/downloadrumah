<?php

/**
 * <meta_config>
 * @path : database/factories/EstateAttachmentFactory.php | usage: Estates Attachment Model Factory
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace Database\Factories;

use App\Models\Estate;
use App\Models\EstateAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstateAttachmentFactory extends Factory
{
    protected $model = EstateAttachment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        /**
         * Menggunakan URL placeholder yang stabil agar aman dari broken link saat seeding
         */
        $sampleImages = [
            'https://placehold.co/800x600/2b2b2b/ffffff.jpg?text=Estate+Photo+1',
            'https://placehold.co/800x600/2b2b2b/ffffff.jpg?text=Estate+Photo+2',
            'https://placehold.co/800x600/2b2b2b/ffffff.jpg?text=Estate+Photo+3',
        ];

        return [
            'estate_id' => Estate::factory(),
            'file_path' => fake()->randomElement($sampleImages),
            'file_type' => 'image',
            'is_primary' => false,
            'sort_order' => fake()->numberBetween(1, 5),
        ];
    }
}

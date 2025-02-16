<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicationsSections>
 */
class PublicationsSectionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subheading' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'nature', true),
            'order' => $this->faker->randomDigit(),
            'publication_id' => \App\Models\Publications::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publications>
 */
class PublicationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6), 
            'description' => $this->faker->text(40), 
            'user_id' => \App\Models\User::factory(), // Crea un usuario relacionado
            'categories_id' => \App\Models\Categories::factory(), // Crea una categoría relacionada
        ];
    }
}

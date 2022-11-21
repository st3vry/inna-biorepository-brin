<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialBioproject>
 */
class MaterialBioprojectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'bioproject_id' => $this->faker->unique()->numberBetween(1, 50),
            'material_id' => mt_rand(1, 7),
            'description' => $this->faker->sentence(3),
        ];
    }
}

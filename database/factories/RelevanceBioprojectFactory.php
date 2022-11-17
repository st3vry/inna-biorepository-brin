<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelevanceBioproject>
 */
class RelevanceBioprojectFactory extends Factory
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
            'relevance_id' => mt_rand(1, 7),
            'description' => $this->faker->sentence(3),
        ];
    }
}

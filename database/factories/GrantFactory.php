<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grant>
 */
class GrantFactory extends Factory
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
            'fundagency_id' => mt_rand(1, 3),
            'grant_title' => $this->faker->sentence(3),
            'grant_program' => $this->faker->sentence(3),
            'bioproject_id' => mt_rand(1, 15)
        ];
    }
}

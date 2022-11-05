<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Umbrellaproject>
 */
class UmbrellaprojectFactory extends Factory
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
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(mt_rand(5, 10)),
            'center_id' => mt_rand(1, 2)
        ];
    }
}

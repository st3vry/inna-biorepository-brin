<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BioSampleExternalLink>
 */
class BioSampleExternalLinkFactory extends Factory
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
            'link_description' => $this->faker->sentence(3),
            'link_url' => $this->faker->sentence(3),
            'biosample_id' => mt_rand(1, 15)
        ];
    }
}

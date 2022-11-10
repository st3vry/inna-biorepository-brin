<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Biosample;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biosample>
 */
class BiosampleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static int $id = 0;

    public function definition()
    {
        if (self::$id == 0) {
            self::$id = Biosample::query()->max("id") ?? 0;
        }
        self::$id++;

        return [
            //
            'accession' => 'SAM' . sprintf('%06d', intval(self::$id)),
            'submission_id' => 'SUBSAM' . sprintf('%06d', intval(self::$id)),
            'sample_name' => $this->faker->sentence(3),
            'title' => $this->faker->sentence(3),
            'sampletype_id' => mt_rand(1, 3),
            'organism_id' => mt_rand(1, 4),
            'description' => $this->faker->paragraph(mt_rand(5, 10)),
            'center_id' => mt_rand(1, 2),
            'user_id' => mt_rand(1, 5),
            'draft' => false,
            'published_at' => now()
        ];
    }
}

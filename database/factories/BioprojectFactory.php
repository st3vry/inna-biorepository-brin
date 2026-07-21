<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bioproject;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bioproject>
 */
class BioprojectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Bioproject::class;
    protected static int $id = 0;

    public function definition()
    {
        if (self::$id == 0) {
            self::$id = Bioproject::query()->max("id") ?? 0;
        }
        self::$id++;

        return [
            'accession' => 'INNAP' . sprintf('%06d', intval(self::$id)),
            'submission_id' => 'INNASUBP' . sprintf('%06d', intval(self::$id)),
            'data_type_id' => mt_rand(1, 5),
            'samplescope_id' => mt_rand(1, 3),
            'organism_id' => mt_rand(1, 3),
            'consortium_id' => mt_rand(1, 50),
            'umbproject_id' => mt_rand(1, 50),
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'description' => $this->faker->paragraph(mt_rand(5, 10)),
            'center_id' => mt_rand(1, 2),
            'user_id' => mt_rand(1, 5),
            'curator_id'=>3,
            'draft' => false,
            'published_at' => now()
        ];
    }
}

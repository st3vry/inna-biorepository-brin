<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
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
            'pubmed_id' => $this->faker->text(),
            'doi' => $this->faker->text(),
            'journal_name' => $this->faker->title(),
            'article_title' => $this->faker->title(),
            'year' => $this->faker->year(),
            'volume' => mt_rand(1, 10),
            'issue' => $this->faker->date(),
            'pagefrom' => mt_rand(1, 50),
            'pageto' => mt_rand(1, 50),
            'author_list' => mt_rand(1, 3),
            'bioproject_id' => mt_rand(1, 3),
        ];
    }
}

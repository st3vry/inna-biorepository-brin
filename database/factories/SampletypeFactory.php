<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attribute;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sampletype>
 */
class SampletypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function randomAttr($size)
    {
        $chars    = "123456789";
        $string        = array();
        $alphaLength = strlen($chars) - 1;
        for ($i = 0; $i < $size; $i++) {
            $n      = rand(0, $alphaLength);
            if ($chars[$n] != $string[$n - 1]) {
                $string[] = $chars[$n];
            }
        }
        return implode(',', $string);
    }

    public function definition()
    {
        // $attr = $this->randomAttr(mt_rand(1,5))

        return [
            //
            'name' => $this->faker->sentence(1),
            'attribute_property' => $this->faker->randomElement(array(implode(',', ['1', '2', '3', '4', '5'])), 3),
        ];
    }
}

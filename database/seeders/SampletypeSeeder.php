<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sampletype;

class SampletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Sampletype
        Sampletype::create([
            'name' => 'Clinical or host-associated pathogen',
            'attribute_property' => '1,2,3,4,5,6,8',

        ]);
        Sampletype::create([
            'name' => 'Environmental, food, or other pathogen',
            'attribute_property' => '1,2,3,4,5,8',

        ]);
        Sampletype::create([
            'name' => 'Microbe',
            'attribute_property' => '1,2,4,5,6,7,8',

        ]);
        Sampletype::create([
            'name' => 'Model organism or animal sample',
            'attribute_property' => '1,2,4,5,7',

        ]);

        Sampletype::create([
            'name' => 'Human',
            'attribute_property' => '1,2,3,7,8',

        ]);

        Sampletype::create([
            'name' => 'Plant',
            'attribute_property' => '1,2,5,7',

        ]);

        Sampletype::create([
            'name' => 'Virus',
            'attribute_property' => '1,2,3,4,5,6,7,8',

        ]);

        // Sampletype::factory(10)->create();
    }
}

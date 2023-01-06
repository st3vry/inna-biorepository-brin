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
            'attribute_property' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28',

        ]);
        Sampletype::create([
            'name' => 'Environmental, food, or other pathogen',
            'attribute_property' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',

        ]);
        Sampletype::create([
            'name' => 'Microbe',
            'attribute_property' => '1,2,4,5,6,7,8,9,10,11,12,13,14,17,26,28,29,30,31,32,33,34,35,36,38',

        ]);
        Sampletype::create([
            'name' => 'Model organism or animal sample',
            'attribute_property' => '1,2,4,5,6,8,9,10,11,14,39,30,40,41,42,43,44,37,45,46,47,48,49,50,51,52,53,54,55,56,57,58',

        ]);

        Sampletype::create([
            'name' => 'Human',
            'attribute_property' => '1,2,3,7,10,39,30,40,41,42,43,44,37,45,46,47,52,55,59,60,61,62,63',

        ]);

        Sampletype::create([
            'name' => 'Plant',
            'attribute_property' => '1,2,5,6,9,10,11,14,39,30,40,41,42,43,37,45,46,47,51,55,62,63,64,36,65',

        ]);

        Sampletype::create([
            'name' => 'Virus',
            'attribute_property' => '1,2,3,4,5,6,7,8,9,10,11,12,14,17,26,28,29,30,31,32,33,34,35,36,37',

        ]);

        // Sampletype::factory(10)->create();
    }
}

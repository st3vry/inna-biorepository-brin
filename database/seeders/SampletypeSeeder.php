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
            'name' => 'Plant',
            'attribute_property' => '1,3,4,5',

        ]);
        Sampletype::create([
            'name' => 'Microbe',
            'attribute_property' => '1,3,4,5',

        ]);
        Sampletype::create([
            'name' => 'Human',
            'attribute_property' => '1,3,4,5',

        ]);
        Sampletype::create([
            'name' => 'Animal',
            'attribute_property' => '1,3,4,5',

        ]);

        Sampletype::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProMorphShape;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProMorphShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProMorphShape::create([
            'name' => 'Bacilli',
        ]);
        ProMorphShape::create([
            'name' => 'Cocci',
        ]);
        ProMorphShape::create([
            'name' => 'Spirilla',
        ]);
        ProMorphShape::create([
            'name' => 'Coccobacilli',
        ]);
        ProMorphShape::create([
            'name' => 'Filamentous',
        ]);
        ProMorphShape::create([
            'name' => 'Vibrios',
        ]);
        ProMorphShape::create([
            'name' => 'Fusobacteria',
        ]);
        ProMorphShape::create([
            'name' => 'SquareShaped',
        ]);
        ProMorphShape::create([
            'name' => 'CurvedShaped',
        ]);
        ProMorphShape::create([
            'name' => 'Tailed',
        ]);
    }
}

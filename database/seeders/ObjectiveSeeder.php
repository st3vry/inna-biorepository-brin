<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Objective;

class ObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Objective::create(['name' => 'Raw Sequence Reads']);
        Objective::create(['name' => 'Sequence']);
        Objective::create(['name' => 'Analysis']);
        Objective::create(['name' => 'Assembly']);
        Objective::create(['name' => 'Annotation']);
        Objective::create(['name' => 'Variation']);
        Objective::create(['name' => 'Epigenetic Markers']);
        Objective::create(['name' => 'Expression']);
        Objective::create(['name' => 'Maps']);
        Objective::create(['name' => 'Phenotype']);
        Objective::create(['name' => 'Other']);
    }
}

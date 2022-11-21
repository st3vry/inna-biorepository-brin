<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Material::create([
            'name' => 'Genome'
        ]);
        Material::create([
            'name' => 'Partial Genome'
        ]);
        Material::create([
            'name' => 'Transcriptome'
        ]);
        Material::create([
            'name' => 'Reagent'
        ]);
        Material::create([
            'name' => 'Proteome'
        ]);
        Material::create([
            'name' => 'Phenotype'
        ]);
        Material::create([
            'name' => 'Other'
        ]);
    }
}

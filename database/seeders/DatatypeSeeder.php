<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Datatype;

class DatatypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Datatype
        Datatype::create(['name' => 'Whole genome sequencing']);
        Datatype::create(['name' => 'Clone ends']);
        Datatype::create(['name' => 'Epigemomics']);
        Datatype::create(['name' => 'Exome']);
        Datatype::create(['name' => 'Map']);
        Datatype::create(['name' => 'Metagenome']);
        Datatype::create(['name' => 'Phenotype or Genotype']);
        Datatype::create(['name' => 'Random survey']);
        Datatype::create(['name' => 'Transcriptome or Gene expression']);
        Datatype::create(['name' => 'Other']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organism;

class OrganismSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Organism
        Organism::create([
            'taxon_id' => '9606',
            'name' => 'Homo Sapiens',
        ]);
        Organism::create([
            'taxon_id' => '1036758',
            'name' => 'Parasarocladium radiatum',
        ]);
        Organism::create([
            'taxon_id' => '408170',
            'name' => 'Human Gut Metagenome',
        ]);
        Organism::create([
            'taxon_id' => '123123',
            'name' => 'Organism 4',
        ]);
    }
}

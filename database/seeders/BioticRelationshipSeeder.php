<?php

namespace Database\Seeders;

use App\Models\BioticRelationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BioticRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BioticRelationship::create([
            'name' => 'FreeLiving',
        ]);
        BioticRelationship::create([
            'name' => 'Commensal',
        ]);
        BioticRelationship::create([
            'name' => 'Symbiont',
        ]);
        BioticRelationship::create([
            'name' => 'Episymbiont',
        ]);
        BioticRelationship::create([
            'name' => 'Intracellular',
        ]);
        BioticRelationship::create([
            'name' => 'Parasite',
        ]);
        BioticRelationship::create([
            'name' => 'Host',
        ]);
        BioticRelationship::create([
            'name' => 'Endosymbiont',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ReplLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReplLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ReplLocation::create([
            'name' => 'Nuclear or Prokaryote',
        ]);
        ReplLocation::create([
            'name' => 'Macronuclear',
        ]);
        ReplLocation::create([
            'name' => 'Nucleomorph',
        ]);
        ReplLocation::create([
            'name' => 'Mitochondrion',
        ]);
        ReplLocation::create([
            'name' => 'Kinetoplast',
        ]);
        ReplLocation::create([
            'name' => 'Chloroplast',
        ]);
        ReplLocation::create([
            'name' => 'Chromoplast',
        ]);
        ReplLocation::create([
            'name' => 'Plastid',
        ]);
        ReplLocation::create([
            'name' => 'Virion or Phage',
        ]);
        ReplLocation::create([
            'name' => 'Proviral or Prophage',
        ]);
        ReplLocation::create([
            'name' => 'Viroid',
        ]);
        ReplLocation::create([
            'name' => 'Extrachrom',
        ]);
        ReplLocation::create([
            'name' => 'Cyanelle',
        ]);
        ReplLocation::create([
            'name' => 'Apicoplast',
        ]);
        ReplLocation::create([
            'name' => 'Leucoplast',
        ]);
        ReplLocation::create([
            'name' => 'Proplastid',
        ]);
        ReplLocation::create([
            'name' => 'Hydrogenosome',
        ]);
        ReplLocation::create([
            'name' => 'Chromatophore',
        ]);
        ReplLocation::create([
            'name' => 'Other',
        ]);
    }
}

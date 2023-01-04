<?php

namespace Database\Seeders;

use App\Models\TempRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TempRange::create([
            'name' => 'Cryophilic',
        ]);
        TempRange::create([
            'name' => 'Psychrophilic',
        ]);
        TempRange::create([
            'name' => 'Mesophilic',
        ]);
        TempRange::create([
            'name' => 'Thermophilic',
        ]);
        TempRange::create([
            'name' => 'Hyperthermophilic',
        ]);
        TempRange::create([
            'name' => 'Unknown',
        ]);
    }
}

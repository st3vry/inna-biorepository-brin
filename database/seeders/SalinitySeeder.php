<?php

namespace Database\Seeders;

use App\Models\Salinity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalinitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Salinity::create([
            'name' => 'NonHalophilic',
        ]);
        Salinity::create([
            'name' => 'Mesophilic',
        ]);
        Salinity::create([
            'name' => 'ModerateHalophilic',
        ]);
        Salinity::create([
            'name' => 'ExtremeHalophilic',
        ]);
        Salinity::create([
            'name' => 'Unknown',
        ]);
    }
}

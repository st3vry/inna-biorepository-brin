<?php

namespace Database\Seeders;

use App\Models\Habitat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Habitat::create([
            'name' => 'HostAssociated',
        ]);
        Habitat::create([
            'name' => 'Aquatic',
        ]);
        Habitat::create([
            'name' => 'Terrestrial',
        ]);
        Habitat::create([
            'name' => 'Specialized',
        ]);
        Habitat::create([
            'name' => 'Multiple',
        ]);
        Habitat::create([
            'name' => 'Unknown',
        ]);
    }
}

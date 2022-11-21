<?php

namespace Database\Seeders;

use App\Models\Methodology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MethodologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Methodology::create([
            'name' => 'Sequencing'
        ]);
        Methodology::create([
            'name' => 'Array'
        ]);
        Methodology::create([
            'name' => 'Mass Spectroscopy'
        ]);
        Methodology::create([
            'name' => 'Other'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Celularity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CelularitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Celularity::create([
            'name' => 'Unicellular',
        ]);
        Celularity::create([
            'name' => 'Multicellular',
        ]);
        Celularity::create([
            'name' => 'Colonial',
        ]);
    }
}

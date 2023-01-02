<?php

namespace Database\Seeders;

use App\Models\Reproduction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReproductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Reproduction::create([
            'name' => 'Sexual',
        ]);
        Reproduction::create([
            'name' => 'Asexual',
        ]);
    }
}

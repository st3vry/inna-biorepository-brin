<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Disease;

class DiseaseSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Disease
        Disease::create([
            'name'=>'disease A'
        ]);
        Disease::create([
            'name'=>'disease B'
        ]);
        Disease::create([
            'name'=>'disease C'
        ]);
    }
}
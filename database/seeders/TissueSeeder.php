<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tissue;

class TissueSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Disease
        Tissue::create([
            'name'=>'tissue A'
        ]);
        Tissue::create([
            'name'=>'tissue B'
        ]);
        Tissue::create([
            'name'=>'tissue C'
        ]);
    }
}
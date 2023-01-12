<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sex;

class SexSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sex
        Sex::create([
            'name'=>'male'
        ]);
        Sex::create([
            'name'=>'female'
        ]);
        Sex::create([
            'name'=>'unknown'
        ]);
    }
}
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
            'name'=>'pooled male and female'
        ]);
        Sex::create([
            'name'=>'neuter'
        ]);
        Sex::create([
            'name'=>'hermaphrodite'
        ]);
        Sex::create([
            'name'=>'intersex'
        ]);
        Sex::create([
            'name'=>'note determined'
        ]); 
        Sex::create([
            'name'=>'missing'
        ]);
        Sex::create([
            'name'=>'not applicable'
        ]);
        Sex::create([
            'name'=>'not collected'
        ]);
    }
}
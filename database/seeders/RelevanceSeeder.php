<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Relevance;

class RelevanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Relevance 
        Relevance::create([
            'name' => 'Agricultural'
        ]);
        Relevance::create([
            'name' => 'Medical'
        ]);
        Relevance::create([
            'name' => 'Industrial'
        ]);
        Relevance::create([
            'name' => 'Environtmental'
        ]);
        Relevance::create([
            'name' => 'Evolution'
        ]);
        Relevance::create([
            'name' => 'Model Organism'
        ]);
        Relevance::create([
            'name' => 'Other'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Samplescope;

class SamplescopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Samplescope
        Samplescope::create(['name' => 'Monoisolate']);
        Samplescope::create(['name' => 'Multiisolate']);
        Samplescope::create(['name' => 'Multi-species']);
        Samplescope::create(['name' => 'Environtment']);
        Samplescope::create(['name' => 'Synthetic']);
        Samplescope::create(['name' => 'Single cell']);
        Samplescope::create(['name' => 'Other']);
    }
}

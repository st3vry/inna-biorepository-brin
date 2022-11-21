<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Capture;

class CaptureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Capture::create([
            'name' => 'Whole'
        ]);
        Capture::create([
            'name' => 'Clone Ends'
        ]);
        Capture::create([
            'name' => 'Exome'
        ]);
        Capture::create([
            'name' => 'Targeted Locus'
        ]);
        Capture::create([
            'name' => 'Random Survey'
        ]);
        Capture::create([
            'name' => 'Other'
        ]);
    }
}

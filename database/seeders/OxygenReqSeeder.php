<?php

namespace Database\Seeders;

use App\Models\OxygenReq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OxygenReqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        OxygenReq::create([
            'name' => 'Aerobic',
        ]);
        OxygenReq::create([
            'name' => 'Microaerophilic',
        ]);
        OxygenReq::create([
            'name' => 'Facultative',
        ]);
        OxygenReq::create([
            'name' => 'Anaerobic',
        ]);
        OxygenReq::create([
            'name' => 'Unknown',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lab;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lab
        Lab::create([
            'name' => 'Laboratorium Jamur',
            'center_id' => 1,
            'address' => 'Jalan bunga Teratai',
            'website' => 'www.lab-bunga-teratai.com'
        ]);

        Lab::create([
            'name' => 'Laboratorium Obat',
            'center_id' => 2,
            'address' => 'Jalan bunga Melati',
            'website' => 'www.lab-obat.com'
        ]);

        Lab::create([
            'name' => 'Laboratorium Sequencing',
            'center_id' => 3,
            'address' => 'Jalan bunga Mawar',
            'website' => 'www.lab-sequence.com'
        ]);
    }
}

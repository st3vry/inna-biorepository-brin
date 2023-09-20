<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Center;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Center
        Center::create([
            'name' => 'Badan Riset dan Inovasi Nasional',
            'address' => 'Gedung BJ Habibie',
            'website' => 'www.brin.go.id'
        ]);

        Center::create([
            'name' => 'Universitas Indonesia',
            'address' => 'Depok',
            'website' => 'www.ui.ac.id'
        ]);

        Center::create([
            'name' => 'Pusat Riset Komputasi',
            'address' => 'Cibinong',
            'website' => 'www.prk.brin.go.id'
        ]);
    }
}

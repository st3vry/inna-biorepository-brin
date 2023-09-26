<?php

namespace Database\Seeders;

use App\Models\Consortium;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsortiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Consortium::factory(50)->create();
        Consortium::create([
            'name' => 'Badan Riset dan Inovasi Nasional',
            'url' => 'www.brin.go.id'
        ]);
    }
}

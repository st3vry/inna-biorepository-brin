<?php

namespace Database\Seeders;

use App\Models\GenomeSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenomeSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        GenomeSize::create([
            'name' => 'Kb',
        ]);
        GenomeSize::create([
            'name' => 'Mb',
        ]);
        GenomeSize::create([
            'name' => 'cM',
        ]);
    }
}

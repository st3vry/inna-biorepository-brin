<?php

namespace Database\Seeders;

use App\Models\ReplType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReplTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ReplType::create([
            'name' => 'Chromosome',
        ]);
        ReplType::create([
            'name' => 'Plasmid',
        ]);
        ReplType::create([
            'name' => 'Linkage Group',
        ]);
        ReplType::create([
            'name' => 'Segment',
        ]);
        ReplType::create([
            'name' => 'Other',
        ]);
    }
}

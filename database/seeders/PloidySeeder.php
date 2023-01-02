<?php

namespace Database\Seeders;

use App\Models\Ploidy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PloidySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Ploidy::create([
            'name' => 'Haploid',
        ]);
        Ploidy::create([
            'name' => 'Diploid',
        ]);
        Ploidy::create([
            'name' => 'Polyploid',
        ]);
        Ploidy::create([
            'name' => 'Allopolyploid',
        ]);
    }
}

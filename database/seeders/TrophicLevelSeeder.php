<?php

namespace Database\Seeders;

use App\Models\TrophicLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrophicLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TrophicLevel::create([
            'name' => 'Autotroph',
        ]);
        TrophicLevel::create([
            'name' => 'Heterotroph',
        ]);
        TrophicLevel::create([
            'name' => 'Mixotroph',
        ]);
    }
}

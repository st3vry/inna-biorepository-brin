<?php

namespace Database\Seeders;

use App\Models\LibraryLayout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibraryLayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LibraryLayout::create([
            'name' => 'single',
            'description' => 'Single read'
        ]);
        LibraryLayout::create([
            'name' => 'paired',
            'description' => 'Paired reads'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\LibrarySource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrarySourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LibrarySource::create([
            'name' => 'GENOMIC',
        ]);
        LibrarySource::create([
            'name' => 'TRANSCRIPTOMIC',
        ]);
        LibrarySource::create([
            'name' => 'METAGENOMIC',
        ]);
        LibrarySource::create([
            'name' => 'METATRANSCRIPTOMIC',
        ]);
        LibrarySource::create([
            'name' => 'SYNTHETIC',
        ]);
        LibrarySource::create([
            'name' => 'VIRAL RNA',
        ]);
        LibrarySource::create([
            'name' => 'OTHER',
        ]);
    }
}

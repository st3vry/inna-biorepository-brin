<?php

namespace Database\Seeders;

use App\Models\LibrarySelection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrarySelectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LibrarySelection::create([
            'name' => 'RANDOM',
        ]);
        LibrarySelection::create([
            'name' => 'PCR',
        ]);
        LibrarySelection::create([
            'name' => 'RANDOM PCR',
        ]);
        LibrarySelection::create([
            'name' => 'RT-PCR',
        ]);
        LibrarySelection::create([
            'name' => 'HMPR',
        ]);
        LibrarySelection::create([
            'name' => 'MF',
        ]);
        LibrarySelection::create([
            'name' => 'repeat fractionation',
        ]);
        LibrarySelection::create([
            'name' => 'size fractionation',
        ]);
        LibrarySelection::create([
            'name' => 'MSLL',
        ]);
        LibrarySelection::create([
            'name' => 'cDNA',
        ]);
        LibrarySelection::create([
            'name' => 'cDNA_randomPriming',
        ]);
        LibrarySelection::create([
            'name' => 'cDNA_oligo_dT',
        ]);
        LibrarySelection::create([
            'name' => 'PolyA',
        ]);
        LibrarySelection::create([
            'name' => 'Oligo-dT',
        ]);
        LibrarySelection::create([
            'name' => 'Inverse rRNA',
        ]);
        LibrarySelection::create([
            'name' => 'ChIP',
        ]);
        LibrarySelection::create([
            'name' => 'MNase',
        ]);
        LibrarySelection::create([
            'name' => 'DNAse',
        ]);
        LibrarySelection::create([
            'name' => 'Hybrid Selection',
        ]);
        LibrarySelection::create([
            'name' => 'Reduced Representation',
        ]);
        LibrarySelection::create([
            'name' => 'Restriction Digest',
        ]);
        LibrarySelection::create([
            'name' => '5-methylcytidine antibody',
        ]);
        LibrarySelection::create([
            'name' => 'MBD2 protein methyl-CpG binding domain',
        ]);
        LibrarySelection::create([
            'name' => 'CAGE',
        ]);
        LibrarySelection::create([
            'name' => 'RACE',
        ]);
        LibrarySelection::create([
            'name' => 'MDA',
        ]);
        LibrarySelection::create([
            'name' => 'padlock probes capture method',
        ]);
        LibrarySelection::create([
            'name' => 'other',
        ]);
        LibrarySelection::create([
            'name' => 'unspecified',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\LibraryStrategy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibraryStrategySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LibraryStrategy::create([
            'name' => 'WGS',
        ]);
        LibraryStrategy::create([
            'name' => 'WGA',
        ]);
        LibraryStrategy::create([
            'name' => 'WXS',
        ]);
        LibraryStrategy::create([
            'name' => 'RNA-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'miRNA-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'ncRNA-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'ssRNA-seq',
        ]);
        LibraryStrategy::create([
            'name' => 'WCS',
        ]);
        LibraryStrategy::create([
            'name' => 'CLONE',
        ]);
        LibraryStrategy::create([
            'name' => 'POOLCLONE',
        ]);
        LibraryStrategy::create([
            'name' => 'AMPLICON',
        ]);
        LibraryStrategy::create([
            'name' => 'CLONEEND',
        ]);
        LibraryStrategy::create([
            'name' => 'FINISHING',
        ]);
        LibraryStrategy::create([
            'name' => 'RAD-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'ChIP-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'MNase-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'DNase-Hypersensitivity',
        ]);
        LibraryStrategy::create([
            'name' => 'Bisulfite-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'EST',
        ]);
        LibraryStrategy::create([
            'name' => 'FL-cDNA',
        ]);
        LibraryStrategy::create([
            'name' => 'CTS',
        ]);
        LibraryStrategy::create([
            'name' => 'MRE-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'MeDIP-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'MBD-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'Tn-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'FAIRE-seq',
        ]);
        LibraryStrategy::create([
            'name' => 'SELEX',
        ]);
        LibraryStrategy::create([
            'name' => 'NOMe-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'RIP-Seq',
        ]);
        LibraryStrategy::create([
            'name' => 'ChIA-PET',
        ]);
        LibraryStrategy::create([
            'name' => 'Hi-C',
        ]);
        LibraryStrategy::create([
            'name' => 'ATAC-seq',
        ]);
        LibraryStrategy::create([
            'name' => 'Targeted-Capture',
        ]);
        LibraryStrategy::create([
            'name' => 'Tethered Chromatin Conformation Capture',
        ]);
        LibraryStrategy::create([
            'name' => 'Synthetic-Long-Read',
        ]);
        LibraryStrategy::create([
            'name' => 'Other',
        ]);
    }
}

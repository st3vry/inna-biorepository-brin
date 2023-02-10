<?php

namespace Database\Seeders;

use App\Models\FileType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        FileType::create([
            'name' => 'fastq',
            'description' => 'fastq file',
        ]);
        FileType::create([
            'name' => 'hdf5',
            'description' => 'PacBio hdf5 Format file',
        ]);
        FileType::create([
            'name' => 'bam',
            'description' => 'Binary SAM format for use by loaders that combine alignment and sequencing data',
        ]);
        FileType::create([
            'name' => 'tab',
            'description' => 'A tab-delimited table maps “SN in SQ line of BAM header” and “reference fasta file”',
        ]);
        FileType::create([
            'name' => 'reference_fasta',
            'description' => 'Reference sequence file in single fasta format used to construct SRA archive file format. Filename must end with “.fa”',
        ]);
    }
}

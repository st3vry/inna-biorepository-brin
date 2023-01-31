<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SampletypePackage;

class SampletypePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // SampletypePackage
        SampletypePackage::create([
            'name' => 'Standard',
            'description' => 'When it is not appropriate to use MIxS, use standard packages according to sample types and organisms. For GEA functional genomics data and MetaboBank metabolomics data, “Omics” package is recommended.',
        ]);
        SampletypePackage::create([
            'name' => 'Pathogen',
            'description' => 'Use for pathogen samples that are relevant to public health. Required attributes include those considered useful for the rapid analysis and trace back of pathogens. (bakteri, virus, jamur)',
        ]);
        SampletypePackage::create([
            'name' => 'MIGS Cultured Bacterial/Archaeal Genomic Sequences (MIGS.ba)',
            'description' => 'Use for cultured bacterial or archaeal genomic sequences. Organism must have lineage Bacteria or Archaea.',
        ]);
        SampletypePackage::create([
            'name' => 'Eukaryotic Genomic Sequences (MIGS.eu)',
            'description' => 'Use for eukaryotic genomic sequences. Organism must have lineage Eukaryota.',
        ]);
        SampletypePackage::create([
            'name' => 'Viral Genomic Sequences (MIGS.vi)',
            'description' => 'Use for virus genomic sequences. Organism must have lineage Viruses.',
        ]);
        SampletypePackage::create([
            'name' => 'Environmental/Metagenome Genomic Sequences (MIMS.me)',
            'description' => 'Use for environmental and metagenome sequences. Organism must be a metagenome, where lineage starts with unclassified sequences and scientific name ends with ‘metagenome’.',
        ]);
        SampletypePackage::create([
            'name' => 'Metagenome-assembled Genome Sequences (MIMAG)',
            'description' => 'Use for metagenome-assembled genome sequences produced using computational binning tools that group sequences into individual organism genome assemblies starting from metagenomic data sets. Organism cannot contain the term ‘metagenome’. Use the MIUVIG package for virus genomes.',
        ]);
        SampletypePackage::create([
            'name' => 'Single Amplified Genome Sequences (MISAG)',
            'description' => 'Use for single amplified genome sequences produced by isolating individual cells, amplifying the genome of each cell using whole genome amplification, and then sequencing the amplified DNA. Organism cannot contain the term ‘metagenome’.',
        ]);
        SampletypePackage::create([
            'name' => 'Specimen Marker Sequences (MIMARKS.specimen)',
            'description' => 'Use for any type of marker gene sequences, eg, 16S, 18S, 23S, 28S rRNA or COI obtained directly from the environment, without culturing or identification of the organisms. Organism must be a metagenome, where lineage starts with unclassified sequences and scientific name ends with ‘metagenome’.',
        ]);
        SampletypePackage::create([
            'name' => 'Survey related Marker Sequences (MIMARKS.survey)',
            'description' => 'When it is not appropriate to use MIxS, use standard packages according to sample types and organisms. For GEA functional genomics data and MetaboBank metabolomics data, “Omics” package is recommended.',
        ]);
        SampletypePackage::create([
            'name' => 'Uncultivated Viral Genome Sequences (MIUVIG)',
            'description' => 'Use for uncultivated virus genome identified in metagenome and metatranscriptome datasets. Organism must have lineage Viruses.',
        ]);
    }
}

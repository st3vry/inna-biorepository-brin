<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attributesample;

class AttributeSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Attributesample
        Attributesample::create([
            'attr_name'=>'sample_name',
            'attr_text'=>'Sample Name',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'organism',
            'attr_text'=>'Organism',
            'input_type_id'=>3
        ]);
        Attributesample::create([
            'attr_name'=>'isolate',
            'attr_text'=>'Isolate',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'strain',
            'attr_text'=>'Strain',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'isolation_source',
            'attr_text'=>'Isolation Source',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'collected_by',
            'attr_text'=>'Collected By',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'collection_date',
            'attr_text'=>'Collection Date',
            'input_type_id'=>4
        ]);
        Attributesample::create([
            'attr_name'=>'geographic_location',
            'attr_text'=>'Geographic Location',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'lat_lon',
            'attr_text'=>'Latitude Longitude',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'culture_collection',
            'attr_text'=>'Culture Collection',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'genotype',
            'attr_text'=>'Genotype',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'passage_history',
            'attr_text'=>'Passage History',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'serovar',
            'attr_text'=>'Serovar',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'specimen_voucher',
            'attr_text'=>'Specimen Voucher',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'subgroup',
            'attr_text'=>'Subgroup',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'subtype',
            'attr_text'=>'Subtype',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'host',
            'attr_text'=>'Host',
            'input_type_id'=>3
        ]);
        Attributesample::create([
            'attr_name'=>'host_disease',
            'attr_text'=>'Host Disease',
            'input_type_id'=>3
        ]);
        Attributesample::create([
            'attr_name'=>'host_age',
            'attr_text'=>'Host Age',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'host_description',
            'attr_text'=>'Host Description',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'host_disease_outcome',
            'attr_text'=>'Host Disease Outcome',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'host_disease_stage',
            'attr_text'=>'Host Disease Stage',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'host_health_outcome',
            'attr_text'=>'Host Health Outcome',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'host_sex',
            'attr_text'=>'Host Sex',
            'input_type_id'=>3
        ]);
        Attributesample::create([
            'attr_name'=>'host_subject_id',
            'attr_text'=>'Host Subject Id',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'host_tissue_sampled',
            'attr_text'=>'Host Tissue Sampled',
            'input_type_id'=>3
        ]);
        Attributesample::create([
            'attr_name'=>'pathotype',
            'attr_text'=>'Pathotype',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'serotype',
            'attr_text'=>'Serotype',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'altitude',
            'attr_text'=>'Altitude',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'biomaterial_provider',
            'attr_text'=>'Biomaterial Provider',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'lab_host',
            'attr_text'=>'Lab Host',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'depth',
            'attr_text'=>'Depth',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'environmental_biome',
            'attr_text'=>'Environmental Biome',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'identified_by',
            'attr_text'=>'Identified By',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'sample_size',
            'attr_text'=>'Sample Size',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'temperature',
            'attr_text'=>'Temperature',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'disease',
            'attr_text'=>'Disease',
            'input_type_id'=>3
        ]);
        Attributesample::create([
            'attr_name'=>'mating_type',
            'attr_text'=>'Mating Type',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'age',
            'attr_text'=>'Age',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'sex',
            'attr_text'=>'Sex',
            'input_type_id'=>3
        ]);
        Attributesample::create([
            'attr_name'=>'tissue',
            'attr_text'=>'Tissue',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'cell_line',
            'attr_text'=>'Cell Line',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'cell_type',
            'attr_text'=>'Cell TYpe',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'cell_subtype',
            'attr_text'=>'Cell Subtype',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'disease_stage',
            'attr_text'=>'Disease Stage',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'development_stage',
            'attr_text'=>'Development Stage',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'phenotype',
            'attr_text'=>'Phenotype',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'birth_location',
            'attr_text'=>'Birth Location',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'birth_date',
            'attr_text'=>'Birth Date',
            'input_type_id'=>4
        ]);
        Attributesample::create([
            'attr_name'=>'death_date',
            'attr_text'=>'Death Date',
            'input_type_id'=>4
        ]);
        Attributesample::create([
            'attr_name'=>'growth_protocol',
            'attr_text'=>'Growth Protocol',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'health_state',
            'attr_text'=>'Health State',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'storage_condition',
            'attr_text'=>'Storage Condition',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'study_book_number',
            'attr_text'=>'Study Book Number',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'treatment',
            'attr_text'=>'Treatment',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'breed',
            'attr_text'=>'Breed',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'breed_history',
            'attr_text'=>'Breed History',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'breed_method',
            'attr_text'=>'Breed Method',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'ethnicity',
            'attr_text'=>'Ethnicity',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'race',
            'attr_text'=>'Race',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'karyotype',
            'attr_text'=>'Karyotype',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'population',
            'attr_text'=>'Population',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'type',
            'attr_text'=>'Type',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'height_length',
            'attr_text'=>'Height or Length',
            'input_type_id'=>1
        ]);
        Attributesample::create([
            'attr_name'=>'cultivar',
            'attr_text'=>'Cultivar',
            'input_type_id'=>1
        ]);
    }
}

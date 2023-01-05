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
            'attr_name'=>'sample_name'
        ]);
        Attributesample::create([
            'attr_name'=>'organism'
        ]);
        Attributesample::create([
            'attr_name'=>'isolate'
        ]);
        Attributesample::create([
            'attr_name'=>'strain'
        ]);
        Attributesample::create([
            'attr_name'=>'isolation_source'
        ]);
        Attributesample::create([
            'attr_name'=>'host'
        ]);
        Attributesample::create([
            'attr_name'=>'biomaterial_provider'
        ]);
        Attributesample::create([
            'attr_name'=>'collection_date'
        ]);
    }
}

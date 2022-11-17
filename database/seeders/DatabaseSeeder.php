<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bioproject;
use App\Models\Biosample;
use App\Models\User;
use App\Models\Organism;
use App\Models\Center;
use App\Models\Datatype;
use App\Models\Fundagency;
use App\Models\Grant;
use App\Models\Lab;
use App\Models\Publication;
use App\Models\Samplescope;
use App\Models\Umbrellaproject;
use App\Models\Role;
use App\Models\Sampletype;
use App\Models\Attribute;
use App\Models\Attributesample;
use App\Models\Relevance;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User
        User::create([
            'name' => 'Admin Administrator',
            'username' => 'admin123',
            'email' => 'admin.administrator@gmail.com',
            'password' => bcrypt('12345'),
            'role_id' => 1,
            'is_activated' => true,
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('12345'),
            'role_id' => 2,
            'is_activated' => true,
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'John Doe 2',
            'username' => 'johndoe2',
            'email' => 'john.doe2@gmail.com',
            'password' => bcrypt('12345'),
            'role_id' => 3,
            'is_activated' => true,
            'remember_token' => Str::random(10)
        ]);

        User::factory(20)->create();

        // Samplescope
        Samplescope::create(['name' => 'Monoisolate']);
        Samplescope::create(['name' => 'Multiisolate']);
        Samplescope::create(['name' => 'Multi-species']);
        Samplescope::create(['name' => 'Environtment']);
        Samplescope::create(['name' => 'Synthetic']);
        Samplescope::create(['name' => 'Single cell']);
        Samplescope::create(['name' => 'Other']);

        // Datatype
        Datatype::create(['name' => 'Whole genome sequencing']);
        Datatype::create(['name' => 'Clone ends']);
        Datatype::create(['name' => 'Epigemomics']);
        Datatype::create(['name' => 'Exome']);
        Datatype::create(['name' => 'Map']);
        Datatype::create(['name' => 'Metagenome']);
        Datatype::create(['name' => 'Phenotype or Genotype']);
        Datatype::create(['name' => 'Random survey']);
        Datatype::create(['name' => 'Transcriptome or Gene expression']);

        // Organism
        Organism::create([
            'taxon_id' => '9606',
            'name' => 'Homo Sapiens',
        ]);
        Organism::create([
            'taxon_id' => '1036758',
            'name' => 'Parasarocladium radiatum',
        ]);
        Organism::create([
            'taxon_id' => '408170',
            'name' => 'Human Gut Metagenome',
        ]);
        Organism::create([
            'taxon_id' => '123123',
            'name' => 'Organism 4',
        ]);


        //Relevance 
        Relevance::create([
            'name' => 'Agricultural'
        ]);
        Relevance::create([
            'name' => 'Agricultural'
        ]);
        Relevance::create([
            'name' => 'Agricultural'
        ]);
        Relevance::create([
            'name' => 'Agricultural'
        ]);
        Relevance::create([
            'name' => 'Other'
        ]);

        // Center
        Center::create([
            'name' => 'Badan Riset dan Inovasi Nasional',
            'address' => 'Gedung BJ Habibie',
            'website' => 'www.brin.go.id'
        ]);

        Center::create([
            'name' => 'Universitas Indonesia',
            'address' => 'Depok',
            'website' => 'www.ui.ac.id'
        ]);


        // Lab
        Lab::create([
            'name' => 'Laboratorium Jamur',
            'center_id' => 1,
            'address' => 'Jalan bunga Teratai',
            'website' => 'www.lab-bunga-teratai.com'
        ]);

        Lab::create([
            'name' => 'Laboratorium Obat',
            'center_id' => 2,
            'address' => 'Jalan bunga Melati',
            'website' => 'www.lab-obat.com'
        ]);

        // Role
        Role::create([
            'name' => 'administrator'
        ]);
        Role::create([
            'name' => 'curator'
        ]);
        Role::create([
            'name' => 'user'
        ]);

        // Sampletype
        Sampletype::create([
            'name' => 'Plant',
            'attribute_property' => '1,3,4,5',

        ]);
        Sampletype::create([
            'name' => 'Microbe',
            'attribute_property' => '1,3,4,5',

        ]);
        Sampletype::create([
            'name' => 'Human',
            'attribute_property' => '1,3,4,5',

        ]);
        Sampletype::create([
            'name' => 'Animal',
            'attribute_property' => '1,3,4,5',

        ]);

        // Factories
        Bioproject::factory(50)->create();
        Biosample::factory(50)->create();
        Sampletype::factory(10)->create();
        Attributesample::factory(30)->create();
        Publication::factory(50)->create();
        Umbrellaproject::factory(3)->create();
        Fundagency::factory(30)->create();
        Grant::factory(50)->create();
    }
}

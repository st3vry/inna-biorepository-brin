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
use App\Models\CaptureBioproject;
use App\Models\Consortium;
use App\Models\Material;
use App\Models\MaterialBioproject;
use App\Models\MethodologyBioproject;
use App\Models\Relevance;
use App\Models\RelevanceBioproject;
use Illuminate\Support\Str;
use Faker\Generator;

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

        $faker = app(Generator::class);

        // Factories
        Bioproject::factory(50)->create();
        Biosample::factory(50)->create();
        Attributesample::factory(30)->create();
        Publication::factory(50)->create();
        Umbrellaproject::factory(3)->create();
        Fundagency::factory(30)->create();
        Grant::factory(50)->create();

        // Relevance, Material Bioproject
        $max = 50;
        for ($c = 1; $c <= $max; $c++) {
            RelevanceBioproject::create([
                'bioproject_id' => $c,
                'relevance_id' => mt_rand(1, 7),
                'description' => $faker->sentence(3),
            ]);
            MaterialBioproject::create([
                'bioproject_id' => $c,
                'material_id' => mt_rand(1, 7),
                'description' => $faker->sentence(3),
            ]);
            CaptureBioproject::create([
                'bioproject_id' => $c,
                'capture_id' => mt_rand(1, 6),
                'description' => $faker->sentence(3),
            ]);
            MethodologyBioproject::create([
                'bioproject_id' => $c,
                'methodology_id' => mt_rand(1, 4),
                'description' => $faker->sentence(3),
            ]);
        }

        $this->call([
            UserSeeder::class,
            SamplescopeSeeder::class,
            DatatypeSeeder::class,
            OrganismSeeder::class,
            RelevanceSeeder::class,
            CenterSeeder::class,
            LabSeeder::class,
            RoleSeeder::class,
            SampletypeSeeder::class,
            MaterialSeeder::class,
            CaptureSeeder::class,
            MethodologySeeder::class,
            ConsortiumSeeder::class
        ]);
    }
}

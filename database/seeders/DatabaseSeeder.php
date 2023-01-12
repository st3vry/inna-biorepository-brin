<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bioproject;
use App\Models\Biosample;
use App\Models\Fundagency;
use App\Models\Grant;
use App\Models\Publication;
use App\Models\Umbrellaproject;
use App\Models\Attributesample;
use App\Models\BioProjectExternalLink;
use App\Models\BioSampleExternalLink;
use App\Models\CaptureBioproject;
use App\Models\DatatypeBioproject;
use App\Models\ObjectiveBioProject;
use App\Models\MaterialBioproject;
use App\Models\MethodologyBioproject;
use App\Models\RelevanceBioproject;
use App\Models\ReplType;
use App\Models\TrophicLevel;
use App\Models\Sex;
use App\Models\Disease;
use App\Models\Tissue;
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
        //Attributesample::factory(30)->create();
        Publication::factory(50)->create();
        Umbrellaproject::factory(3)->create();
        Fundagency::factory(30)->create();
        Grant::factory(50)->create();
        BioProjectExternalLink::factory(50)->create();
        BioSampleExternalLink::factory(50)->create();

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
            DatatypeBioproject::create([
                'bioproject_id' => $c,
                'datatype_id' => mt_rand(1, 10),
                'description' => $faker->sentence(3),
            ]);

            ObjectiveBioProject::create([
                'bioproject_id' => $c,
                'objective_id' => mt_rand(1, 11),
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
            ConsortiumSeeder::class,
            PubIdentifierSeeder::class,
            ObjectiveSeeder::class,
            CelularitySeeder::class,
            ReproductionSeeder::class,
            PloidySeeder::class,
            GenomeSizeSeeder::class,
            BioticRelationshipSeeder::class,
            TrophicLevelSeeder::class,
            AttributeSampleSeeder::class,
            ProMorphShapeSeeder::class,
            HabitatSeeder::class,
            SalinitySeeder::class,
            OxygenReqSeeder::class,
            TempRangeSeeder::class,
            ReplTypeSeeder::class,
            ReplLocationSeeder::class,
            InputFormTypeSeeder::class,
            SexSeeder::class,
            DiseaseSeeder::class,
            TissueSeeder::class,
        ]);
    }
}

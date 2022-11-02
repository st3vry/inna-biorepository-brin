<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bioproject;
use App\Models\User;
use App\Models\Organism;
use App\Models\Center;
use App\Models\Lab;
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
        User::create([
            'name' => 'Sahid Bismantoko',
            'username' => 'sahidbis',
            'email' => 'sahid.bismantoko@gmail.com',
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(10)
        ]);
        // User::create([
        //     'name' => 'Ujang Kasep',
        //     'email' => 'ujang.kasep@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);
        User::factory(30)->create();

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

        Lab::create([
            'name' => 'Laboratorium Jamur',
            'center_id' => mt_rand(1, 2),
            'address' => 'Jalan bunga Teratai',
            'website' => 'www.lab-bunga-teratai.com'
        ]);




        Bioproject::factory(50)->create();

        // Bioproject::create([
        //     'alias' => 'PRJ000001',
        //     'relevance' => 'medical',
        //     'data_type_id' => '4,5,6',
        //     'sample_scope' => 1,
        //     'organism_id' => 1,
        //     'umbproject_id' => 1,
        //     'title' => 'Single-cell sequencing reveals the landscape of the tumor microenvironment in a skeletal undifferentiated pleomorphic sarcoma patient',
        //     'description' => 'Skeletal undifferentiated pleomorphic sarcoma (SUPS) is an invasive pleomorphic soft tissue sarcoma with a high degree of malignancy and poor prognosis. It is prone to recur and metastasize. The tumor microenvironment (TME) and the pathophysiology of SUPS are barely described. Single-cell RNA sequencing (scRNA-seq) provides an opportunity to dissect the landscape of human diseases at an unprecedented resolution, particularly in diseases lacking animal models, such as SUPS. We performed scRNA-seq to analyze tumor tissues and paracancer tissues from a SUPS patient. We identified the cell types and the corresponding marker genes in this SUPS case. We further showed that CD8+ exhausted T cells and Tregs highly expressed PDCD1, CTLA4 and TIGIT. Thus, PDCD1, CTLA4 and TIGIT were identified as potential targets in this case. We applied copy number karyotyping of aneuploid tumors (CopyKAT) to distinguish malignant cells from normal cells in fibroblasts. Our study identified eight malignant fibroblast subsets in SUPS with distinct gene expression profiles. C1-malignant Fibroblast and C6-malignant Fibroblast in the TME play crucial roles in tumor growth, angiogenesis, metastasis and immune response. Hence, targeting malignant fibroblasts could represent a potential strategy for this SUPS therapy. Intervention via tirelizumab enabled disease control, and immune checkpoint inhibitors (ICIs) of PD-1 may be considered as the first-line option in patients with SUPS. Taken together, scRNA-seq analyses provided a powerful basis for this SUPS treatment, improved our understanding of complex human diseases, and may afforded an alternative approach for personalized medicine in the future.',
        //     'center_id' => 1,
        //     'user_id' => 1,
        //     'published_at' => now()

        // ]);

        // Bioproject::create([
        //     'alias' => 'PRJ000002',
        //     'relevance' => 'medical',
        //     'data_type_id' => '4,5,6',
        //     'sample_scope' => 1,
        //     'organism_id' => 1,
        //     'umbproject_id' => 1,
        //     'title' => 'Persistent imbalance of immune homeostasis in convalescent COVID-19 patients',
        //     'description' => 'Peripheral blood mononuclear cells (PBMCs) of convalescent patients with COVID-19 and of healthy controls were analyzed by single-cell RNA sequencing. ',
        //     'center_id' => 2,
        //     'user_id' => 2,
        //     'published_at' => now()
        // ]);
    }
}

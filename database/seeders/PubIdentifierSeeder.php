<?php

namespace Database\Seeders;

use App\Models\PubIdentifier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PubIdentifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PubIdentifier::create([
            'name' => 'PubMed'
        ]);
        PubIdentifier::create([
            'name' => 'DOI'
        ]);
    }
}

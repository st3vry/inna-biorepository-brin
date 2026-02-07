<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_project_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bioproject_id');
            $table->string('organism_novel')->nullable();
            $table->string('organism_novel_description')->nullable();
            $table->string('organism_sbc')->nullable();
            $table->string('organism_isolate')->nullable();
            $table->string('organism_desc')->nullable();
            $table->foreignId('celularity_id')->nullable();
            $table->foreignId('reproduction_id')->nullable();
            $table->foreignId('ploidy_id')->nullable();
            $table->string('ploidy_description')->nullable();
            $table->string('haploid_genome_size')->nullable();
            $table->foreignId('genome_size_id')->nullable();
            $table->string('phenotypes_disease')->nullable();
            $table->foreignId('biotic_relationship_id')->nullable();
            $table->foreignId('trophic_level_id')->nullable();
            $table->string('prokaryote_morphology_gram')->nullable();
            $table->string('prokaryote_morphology_motility')->nullable();
            $table->string('prokaryote_morphology_enveloped')->nullable();
            $table->string('prokaryote_morphology_endospores')->nullable();
            $table->foreignId('habitat_id')->nullable();
            $table->foreignId('salinity_id')->nullable();
            $table->foreignId('oxygen_req_id')->nullable();
            $table->foreignId('temp_range_id')->nullable();
            $table->string('optimum_temp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bio_project_targets');
    }
};

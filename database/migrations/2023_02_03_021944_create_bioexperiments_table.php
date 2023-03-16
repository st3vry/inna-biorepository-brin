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
        Schema::create('bioexperiments', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->foreignId('bioproject_id');
=======
            $table->foreignId('bioarchive_id');
>>>>>>> cb602c39fce0dfde8adc02e2372dcbd607bb805e
            $table->foreignId('biosample_id');
            $table->string('alias');
            $table->string('title');
            $table->string('libname');
            $table->foreignId('libsource_id');
            $table->foreignId('libselection_id');
            $table->foreignId('libstrategy_id');
            $table->string('libconsprot');
            $table->foreignId('instrument_id');
            $table->foreignId('liblayout_id');
            $table->integer('input_size');
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
        Schema::dropIfExists('bioexperiments');
    }
};

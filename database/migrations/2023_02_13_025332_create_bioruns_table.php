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
        Schema::create('bioruns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bioexperiment_id');
            $table->string('alias');
            $table->string('filename')->nullable();
            $table->string('md5')->nullable();
            $table->foreignId('filetype_id');
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
        Schema::dropIfExists('bioruns');
    }
};

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
        Schema::create('organism_replicons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bioproject_id');
            $table->string('name')->nullable();
            $table->foreignId('repl_type_id')->nullable();
            $table->foreignId('repl_location_id')->nullable();
            $table->string('size')->nullable();
            $table->foreignId('genome_size_id')->nullable();
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
        Schema::dropIfExists('organism_replicons');
    }
};

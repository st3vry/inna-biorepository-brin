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
        Schema::create('biosamples', function (Blueprint $table) {
            $table->id();
            $table->string('accession')->unique()->nullable();
            $table->string('submission_id')->unique();
            //$table->string('sample_name');
            $table->string('title');
            $table->boolean('hold_release')->default(false);
            $table->text('comments')->nullable();
            $table->foreignId('sampletype_id');
            $table->foreignId('organism_id');
            $table->text('description');
            $table->integer('center_id');
            $table->foreignId('user_id');
            $table->integer('curator_id')->nullable();
            $table->boolean('draft')->default(false);
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('biosamples');
    }
};

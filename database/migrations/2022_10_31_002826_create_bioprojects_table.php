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
        Schema::create('bioprojects', function (Blueprint $table) {
            $table->id();
            $table->string('accession')->unique()->nullable();
            $table->string('submission_id')->unique();
            $table->string('data_type_id');
            $table->foreignId('samplescope_id');
            $table->foreignId('organism_id');
            $table->foreignId('consortium_id');
            $table->integer('umbproject_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->integer('center_id');
            $table->foreignId('user_id');
            $table->integer('curator_id')->nullable();
            $table->boolean('hold_release')->default(false);
            $table->boolean('draft')->default(false);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('bioprojects');
    }
};

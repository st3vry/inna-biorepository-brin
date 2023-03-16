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
        Schema::create('bioarchives', function (Blueprint $table) {
            $table->id();
            $table->string('accession')->unique()->nullable();
            $table->string('submission_id')->unique();
            $table->foreignId('bioproject_id');
            $table->string('biosample_id');
<<<<<<< HEAD
            $table->string('title');
            $table->string('file_location');
=======
            $table->foreignId('user_id');
            $table->string('curator_id')->nullable();
            $table->boolean('hold_release')->default(false);
            $table->boolean('draft')->default(false);
            $table->integer('status')->default(1);
            $table->timestamp('published_at')->nullable();
>>>>>>> cb602c39fce0dfde8adc02e2372dcbd607bb805e
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
        Schema::dropIfExists('bioarchives');
    }
};

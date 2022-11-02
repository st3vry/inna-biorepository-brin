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
            $table->string('alias')->unique();
            $table->string('relevance');
            $table->string('data_type_id');
            $table->foreignId('samplescope_id');
            $table->foreignId('organism_id');
            $table->integer('umbproject_id');
            $table->string('title');
            $table->text('description');
            $table->integer('center_id');
            $table->foreignId('user_id');
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

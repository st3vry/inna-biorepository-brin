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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pub_identifier_id');
            $table->string('pub_id');
            // $table->string('journal_name');
            $table->string('article_title');
            // $table->year('year');
            // $table->tinyText('volume');
            // $table->tinyText('issue');
            // $table->tinyInteger('pagefrom');
            // $table->tinyInteger('pageto');
            // $table->string('author_list');
            $table->foreignId('bioproject_id');
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
        Schema::dropIfExists('publications');
    }
};

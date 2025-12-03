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
        Schema::create('biosample_drafts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('biosample_id')->nullable()->index(); // optional link to real biosample
            $table->string('title')->nullable();
            $table->json('data')->nullable(); // store form fields
            $table->tinyInteger('status')->default(0)->comment('0=draft,1=submitted'); 
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
        Schema::dropIfExists('biosample_drafts');
    }
};

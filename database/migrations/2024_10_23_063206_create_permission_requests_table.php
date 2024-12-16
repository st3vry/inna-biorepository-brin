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
        Schema::create('permission_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bioarchive_id');
            $table->string('bioarchive_accession');
            $table->text('reason');
            $table->string('research_area');
            $table->string('research_title');
            $table->text('abstract');
            $table->string('proof_of_funding');
            $table->string('letter_of_agreement');
            $table->string('research_proposal');
            $table->string('cv');
            $table->boolean('is_agreed')->default(false);
            $table->boolean('is_approved')->default(false); // Admin approval status
            $table->boolean('is_declined')->default(false); // Admin approval status
            $table->string('path')->default(null);
            $table->text('temporary_url')->default(null); // Temporary URL for file access
            $table->timestamp('temporary_url_expiration')->default(null); // Expiration time for the URL
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
        Schema::dropIfExists('permission_requests');
    }
};

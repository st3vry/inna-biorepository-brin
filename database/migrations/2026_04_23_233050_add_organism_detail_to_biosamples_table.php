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
        Schema::table('biosamples', function (Blueprint $table) {
            $table->json('organism_detail')->nullable()->after('organism_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biosamples', function (Blueprint $table) {
            $table->dropColumn('organism_detail');
        });
    }
};

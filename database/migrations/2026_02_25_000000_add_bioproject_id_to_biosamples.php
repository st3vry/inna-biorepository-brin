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
            $table->foreignId('bioproject_id')->nullable()->after('id')->constrained('bioprojects')->nullOnDelete();
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
            if (Schema::hasColumn('biosamples', 'bioproject_id')) {
                $table->dropForeign(['bioproject_id']);
                $table->dropColumn('bioproject_id');
            }
        });
    }
};

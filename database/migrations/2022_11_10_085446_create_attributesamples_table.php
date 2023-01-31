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
        Schema::create('attributesamples', function (Blueprint $table) {
            $table->id();
            $table->string('attr_name');
            $table->string('attr_text');
            $table->text('description');
            $table->foreignId('input_type_id');
            $table->text('list_value')->nullable();
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
        Schema::dropIfExists('attributesamples');
    }
};

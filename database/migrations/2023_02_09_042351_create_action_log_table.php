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
        Schema::create('action_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // create, edit, delete, assign, request, published
            $table->string('type'); // project, sample, archive
            $table->string('desc')->nullable(); // keterangan might be usefull for later
            $table->string('item_id'); // id dari project, sample, archive
            $table->boolean('seen')->default(false); // untuk keperluan notifikasi
            $table->integer('user_target')->nullable(); // untuk keperluan target notifikasi
            $table->integer('created_by'); // id user yang melakukan action
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
        Schema::dropIfExists('action_log');
    }
};

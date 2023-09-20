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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('username')->nullable();
            $table->string('name')->nullable();
            // $table->string('usernameintra')->unique();
            // $table->string('user_data');
            $table->json('user_data')->nullable();
            // $table->string('external_account')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            $table->boolean('external_account')->default(false);
            // $table->foreignId('lab_id')->default(1);
            // $table->string('administrative')->nullable();
            // $table->string('affiliate')->nullable();
            $table->foreignId('administrative')->default(1);
            $table->foreignId('affiliate')->default(1);
            $table->string('orcid_id')->default('none');
            $table->foreignId('role_id')->default(3);
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->boolean('is_activated')->default(false);
            $table->string('publickey')->nullable();
            $table->string('expired_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

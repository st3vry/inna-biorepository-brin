<?php

use App\Models\User;

class UserService
{
    public function saveUser($data)
    {
        try {
            // $table->string('name');
            // $table->string('username')->unique();
            // $table->string('usernameintra')->unique();
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->foreignId('lab_id')->default(1);
            // $table->string('orcid_id')->default('none');
            // $table->foreignId('role_id')->default(3);
            // $table->string('access_token')->nullable();
            // $table->string('refresh_token')->nullable();
            // $table->boolean('is_activated')->default(false);
            // $table->text('publickey')->nullable();
            $newData = new User();
            $newData->name = $data->name;
            $newData->username = $data->username;
            $newData->usernameintra = $data->usernameintra;
            $newData->email = $data->email;
            $newData->email_verified_at = $data->email_verified_at;
            $newData->external_account = $data->external_account;
            $newData->is_activated = $data->active;
            $newData->access_token = $data->access_token;
            $newData->refresh_token = $data->refresh_token;
            $newData->expired = $data->expired;

            return $newData;
        } catch (Exception $e) {
            throw new Exception("Terjadi kesalahan saat menyimpan data user : " . $e->getMessage());
        }
    }
}

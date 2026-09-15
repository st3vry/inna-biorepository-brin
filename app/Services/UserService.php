<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserService
{
    public function saveUser($data)
    {
        try {
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

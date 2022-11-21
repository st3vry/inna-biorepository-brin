<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // User
    public function run()
    {
        User::create([
            'name' => 'Admin Administrator',
            'username' => 'admin123',
            'email' => 'admin.administrator@gmail.com',
            'password' => bcrypt('12345'),
            'role_id' => 1,
            'is_activated' => true,
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('12345'),
            'role_id' => 2,
            'is_activated' => true,
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'John Doe 2',
            'username' => 'johndoe2',
            'email' => 'john.doe2@gmail.com',
            'password' => bcrypt('12345'),
            'role_id' => 3,
            'is_activated' => true,
            'remember_token' => Str::random(10)
        ]);

        User::factory(20)->create();
    }
}

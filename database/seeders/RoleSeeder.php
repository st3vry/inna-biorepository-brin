<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Role
        Role::create([
            'name' => 'administrator'
        ]);
        Role::create([
            'name' => 'curator'
        ]);
        Role::create([
            'name' => 'user'
        ]);
    }
}

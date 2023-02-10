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
            'name' => 'superadmin',
            'description' => 'Super Admin'
        ]);
        Role::create([
            'name' => 'administrator',
            'description' => 'Centers admin'
        ]);
        Role::create([
            'name' => 'curator',
            'description' => 'Centers curator'
        ]);
        Role::create([
            'name' => 'user',
            'description' => 'Centers member '
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nameRole = [
            'admin',
            'pt',
            'manager',
            'member',
            
        ];

        foreach ($nameRole as  $value) {
            Role::create(['name' => $value]);
        }
    }
}

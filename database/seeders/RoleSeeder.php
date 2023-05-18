<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrador']);
        $bodeguero = Role::create(['name' => 'Bodeguero']);
        $jefe_local = Role::create(['name' => 'Jefe de Local']);
        $trabajador = Role::create(['name' => 'Trabajador']);
        

    }
}

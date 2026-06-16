<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissions
        $viewEquipement = Permission::firstOrCreate(['name' => 'view equipement']);
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users']);

        // roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $rapporteur = Role::firstOrCreate(['name' => 'rapporteur']);

        // assign permissions
        $rapporteur->givePermissionTo($viewEquipement);
        $admin->givePermissionTo([$viewEquipement, $manageUsers]);
    }
}

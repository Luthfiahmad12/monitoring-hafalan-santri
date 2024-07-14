<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $ustadzRole = Role::create(['name' => 'ustadz']);
        $santriRole = Role::create(['name' => 'santri']);

        // Buat permissions
        Permission::create(['name' => 'manage santri']);
        Permission::create(['name' => 'manage surah']);
        Permission::create(['name' => 'manage hafalan']);
        Permission::create(['name' => 'add comment']);
        Permission::create(['name' => 'view own hafalan']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['manage santri', 'manage surah', 'manage hafalan']);
        $ustadzRole->givePermissionTo('add comment');
        $santriRole->givePermissionTo('view own hafalan');
    }
}

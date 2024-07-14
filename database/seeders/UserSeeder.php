<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $ustadz = User::create([
            'name' => 'Ustadz User',
            'email' => 'ustadz@example.com',
            'password' => bcrypt('password'),
        ]);
        $ustadz->assignRole('ustadz');

        $santri = User::create([
            'name' => 'Santri User',
            'email' => 'santri@example.com',
            'password' => bcrypt('password'),
        ]);
        $santri->assignRole('santri');
    }
}

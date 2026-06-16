<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@regideso.cd');
        $adminPassword = env('ADMIN_PASSWORD', 'ChangeMe123!');

        $user = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin',
                'password' => Hash::make($adminPassword),
            ]
        );

        if (method_exists($user, 'assignRole')) {
            $user->assignRole('admin');
        }
    }
}

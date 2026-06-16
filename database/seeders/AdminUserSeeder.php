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
        $user = User::firstOrCreate(
            ['email' => 'gradikidimba299@gmail.com'],
            [
                'name' => 'gradi',
                'password' => Hash::make('Gra299kid1!'),
            ]
        );

        if (method_exists($user, 'assignRole')) {
            $user->assignRole('admin');
        }
    }
}

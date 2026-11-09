<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'tejaslandge21@gmail.com'],
            [
                'name' => 'Tejas Landge',
                'password' => '12341234',
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
        );
    }
}

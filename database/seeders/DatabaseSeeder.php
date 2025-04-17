<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        user::create([
        'name' => 'NEO',
        'role' => 'admin',
        'email' => 'neo@gmail.com',
        'password' => Hash::make("neo@gmail.com")
        ]);

        User::create([
        'name' => 'BANK',
        'role' => 'bank',
        'email' => 'bank@gmail.com',
        'password' => Hash::make("bank@gmail.com")
        ]);

    }     
}
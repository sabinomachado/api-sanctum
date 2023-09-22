<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => "Newton Admin",
            'email' => "newton@t4tech.com",
            'email_verified_at' => now(),
            'password' => 'DevPhpLaravel10+', // password
            'nivel_id' => 1,
            ]);

        \App\Models\User::create([
            'name' => "Sabino Editor",
            'email' => "sabino@machado.com",
            'email_verified_at' => now(),
            'password' => 'DevPhpLaravel10+', // password
            'nivel_id' => 2,
        ]);
    }
}

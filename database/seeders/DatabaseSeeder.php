<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(NivelSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(NewsSeeder::class);

    }
}

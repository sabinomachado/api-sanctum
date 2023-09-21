<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Nivel::create([
            'nivel' => 'Administrador',
        ]);
        \App\Models\Nivel::create([
            'nivel' => 'Editor',
        ]);

    }
}

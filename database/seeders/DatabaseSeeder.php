<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory()->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'rol' => '2',
        ]);

        // Crear un usuario normal
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'rol' => '0',
        ]);

        // Crear un usuario repartidor
        User::factory()->create([
            'name' => 'repartidor',
            'email' => 'repartidor@gmail.com',
            'rol' => '1',
        ]);
    }
}

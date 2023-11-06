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
        $this->call(RoleSeeder::class);
        // \App\Models\User::factory()->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ])->assignRole('admin');

        // Crear un usuario normal
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
        ])->assignRole('usuario');

        // Crear un usuario repartidor
        User::factory()->create([
            'name' => 'repartidor',
            'email' => 'repartidor@gmail.com',
        ])->assignRole('repartidor');
    }
}

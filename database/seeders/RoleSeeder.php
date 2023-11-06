<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=Role::create(['name' => 'admin']);
        $repartidor=Role::create(['name' => 'repartidor']);
        $usuario=Role::create(['name' => 'usuario']);

        Permission::create(['name' => 'categoriasProducto.indexlistado'])->syncRoles([$admin, $repartidor, $usuario]);

        Permission::create(['name' => 'admin.solicitudes'])->assignRole([$admin]);
        Permission::create(['name' => 'solicitudes.show'])->assignRole([$admin]);
        // Permission::create(['name' => 'solicitudes.show'])->assignRole([$admin]);
        Permission::create(['name' => 'solicitudes.aceptadas'])->assignRole([$admin]);

        Permission::create(['name' => 'admin.solicitudesRestaurantes'])->assignRole([$admin]);
        Permission::create(['name' => 'restaurantes.show'])->assignRole([$admin]);
        Permission::create(['name' => 'restaurantes.aceptados'])->assignRole([$admin]);
        // Permission::create(['name' => 'productos.destroy'])->assignRole([$admin]);

        Permission::create(['name' => 'productos.index'])->assignRole([$admin]);
        Permission::create(['name' => 'productos.store'])->assignRole([$admin]);
        Permission::create(['name' => 'productos.update'])->assignRole([$admin]);
        Permission::create(['name' => 'productos.destroy'])->assignRole([$admin]);

        Permission::create(['name' => 'categorias.index'])->assignRole([$admin]);
        Permission::create(['name' => 'categorias.store'])->assignRole([$admin]);
        Permission::create(['name' => 'categorias.update'])->assignRole([$admin]);
        Permission::create(['name' => 'categorias.destroy'])->assignRole([$admin]);

        Permission::create(['name' => 'categoriasRestaurantes.index'])->assignRole([$admin]);
        Permission::create(['name' => 'categoriasRestaurantes.store'])->assignRole([$admin]);       
        Permission::create(['name' => 'categoriasRestaurantes.update'])->assignRole([$admin]);
        Permission::create(['name' => 'categoriasRestaurantes.destroy'])->assignRole([$admin]);    
    }
}

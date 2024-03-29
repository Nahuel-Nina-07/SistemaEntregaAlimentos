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
        $revisor=Role::create(['name' => 'revisor']);
        $repartidor=Role::create(['name' => 'repartidor']);
        $usuario=Role::create(['name' => 'usuario']);

        Permission::create(['name' => 'categoriasProducto.indexlistado'])->syncRoles([$admin, $usuario,]);
        Permission::create(['name' => 'producto.por-categoria'])->syncRoles([$admin, $usuario,]);

        Permission::create(['name' => 'categorias.indexlistado'])->syncRoles([$admin, $usuario,]);
        Permission::create(['name' => 'restaurantes.por-categoria'])->syncRoles([$admin, $usuario,]);

        Permission::create(['name' => 'admin.solicitudes'])->assignRole([$admin]);
        Permission::create(['name' => 'solicitudes.show'])->assignRole([$admin]);
        // Permission::create(['name' => 'solicitudes.show'])->assignRole([$admin]);
        Permission::create(['name' => 'solicitudes.aceptadas'])->assignRole([$admin]);
        //reportes
        Permission::create(['name' => 'reportes.index'])->assignRole([$admin]);
        Permission::create(['name' => 'reportes.detalle'])->assignRole([$admin]);
        //usuarios
        Permission::create(['name' => 'usuarios.index'])->assignRole([$admin]);
        Permission::create(['name' => 'usuarios.toggleStatus'])->assignRole([$admin]);

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


        Permission::create(['name' => 'pedidosrepartidor.index'])->syncRoles([$admin, $repartidor,]);
        Permission::create(['name' => 'pedidosrepartidosr.index'])->syncRoles([$admin, $repartidor,]);
        Permission::create(['name' => 'repartidor.aceptarPedido'])->syncRoles([$admin, $repartidor,]);
        Permission::create(['name' => 'repartidor.detalles'])->syncRoles([$admin, $repartidor,]);

        Permission::create(['name' => 'repartidores.mapa'])->assignRole([$admin]);
        Permission::create(['name' => 'repartidores.detalle'])->assignRole([$admin]);
        Permission::create(['name' => 'repartidores.toggleStatus'])->assignRole([$admin]);


        Permission::create(['name' => 'pedidos-hechos.index'])->syncRoles([$admin, $usuario,]);
        Permission::create(['name' => 'pedidos-hechos.detalles'])->syncRoles([$admin, $usuario,]);
        Permission::create(['name' => 'reportar.repartidor'])->syncRoles([$admin, $usuario,]);
        Permission::create(['name' => 'cancelar.pedido'])->syncRoles([$admin, $usuario,]);
        Permission::create(['name' => 'cancelarPedidoPendiente'])->syncRoles([$admin, $usuario,]);
        Permission::create(['name' => 'pedidos-hechos.detalles-productos'])->syncRoles([$admin, $usuario,]);

        Permission::create(['name' => 'pedidos.pendientes'])->syncRoles([$admin, $repartidor,]);
        Permission::create(['name' => 'pedidos.aceptar'])->syncRoles([$admin, $repartidor,]);
        Permission::create(['name' => 'pedidos.entregar'])->syncRoles([$admin, $repartidor,]);
    }
}

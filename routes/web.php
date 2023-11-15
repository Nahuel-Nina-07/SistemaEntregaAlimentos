<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SolicitudTrabajoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitudTrabajoBasicoController;
use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\AdminSolicitudRestauranteController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CategoriaRestauranteController;
use App\Http\Controllers\AdminSolicitudTrabajoController;
use App\Http\Controllers\registroRestauranteController;
use App\Http\Controllers\formRestauranteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ListadoCategoriaRestauranteController;
use App\Http\Controllers\ListadoCategoriaProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ResetPasswordCopyController;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidosHechosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PedidoRepartidorController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\DetallesUserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//login usuario
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dash.index');
    })->name('dashboard');
});

//datos basicos
Route::get('/ingresar-basicos', [SolicitudTrabajoBasicoController::class, 'index'])->name('repartidor.create');
Route::post('/guardar-basicos', [SolicitudTrabajoBasicoController::class, 'guardarNombreCi'])->name('guardarNombreCi');
Route::get('/ingresar-detallados', [SolicitudTrabajoController::class, 'index']);
Route::post('/guardar-detallados', [SolicitudTrabajoController::class, 'guardarEdadNumero']);


//formulario registro restaurante
Route::get('/ingresar-restaurante', [registroRestauranteController::class, 'index'])->name('registerRestaurante.uneteRestaurante');
Route::post('/guardar-restaurante', [registroRestauranteController::class, 'store']);
Route::get('/formRestaurante', [formRestauranteController::class, 'index']);
Route::post('/guardar-formRestaurante', [formRestauranteController::class, 'store']);

#Plantilla de trabajando en ello
Route::get('/trabajando', function () {
    return view('errors.trabajando');
})->name('trabajando');

Route::get('/pago', function () {
    return view('Pago.pago');
})->name('pagos');

//registrar con google
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();
    $user = User::updateOrCreate(
        ['google_id' => $user_google->id],
        [
            'name' => $user_google->name,
            'email' => $user_google->email,
        ]
    );
    // Verifica si el usuario ya tiene el rol "usuario", si no, asígnaselo
    if (!$user->hasRole('usuario')) {
        $usuarioRole = Role::where('name', 'usuario')->first(); // Asegúrate de que 'usuario' sea el nombre correcto del rol
        if ($usuarioRole) {
            $user->assignRole($usuarioRole);
        }
    }
    Auth::login($user);
    return redirect('/dashboard');
});

//registrar con facebook
Route::get('/auth/redirect', [AuthController::class, 'redirect'])
    ->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])
    ->name('auth.callback');

//Ingresar contraseña solicitud
Route::get('/reset-password-copi/{token}', [ResetPasswordCopyController::class, 'showResetForm'])
    ->name('password.reset-copie');
Route::post('/reset-password-copi', [ResetPasswordCopyController::class, 'update'])
    ->name('password.update');

//contraseña por default
Route::get('/forgot-password', [Laravel\Fortify\Http\Controllers\PasswordResetLinkController::class, 'create'])
    ->name('password.request');


Route::middleware(['auth'])->group(function () {
    //ver las solicitudes //Adminitrador
    Route::get('/ver-solicitudes-pendientes', [AdminSolicitudTrabajoController::class, 'index'])->middleware('can:admin.solicitudes')->name('admin.solicitudes');
    Route::get('/solicitudes/{id}', [AdminSolicitudTrabajoController::class, 'show'])->middleware('can:solicitudes.show')->name('solicitudes.show');
    Route::post('/solicitudes/{id}', [AdminSolicitudTrabajoController::class, 'show'])->middleware('can:solicitudes.show')->name('solicitudes.show');
    Route::get('/solicitudes/aceptadas/{id}', [AdminSolicitudTrabajoController::class, 'verSolicitudesAceptadas'])->middleware('can:solicitudes.aceptadas')->name('solicitudes.aceptadas');

    //restaurantes
    Route::get('/ver-solicitudes-pendientes-restaurantes', [AdminSolicitudRestauranteController::class, 'index'])->middleware('can:admin.solicitudesRestaurantes')->name('admin.solicitudesRestaurantes');
    Route::get('/solicitudes/restaurantes/{id}', [AdminSolicitudRestauranteController::class, 'show'])->middleware('can:restaurantes.show')->name('restaurantes.show');
    Route::post('/solicitudes/restaurantes/{id}', [AdminSolicitudRestauranteController::class, 'show'])->middleware('can:restaurantes.show')->name('restaurantes.show');
    Route::get('/solicitudes/aceptadas/restaurantes/{id}', [AdminSolicitudRestauranteController::class, 'verSolicitudesAceptadas'])->middleware('can:restaurantes.aceptados')->name('restaurantes.aceptados');


    //crud categoriaProducto
    Route::get('/categorias', [CategoriaProductoController::class, 'index'])->middleware('can:categorias.index')->name('categorias.index');
    Route::post('/categorias', [CategoriaProductoController::class, 'store'])->middleware('can:categorias.store')->name('categorias.store');
    Route::put('/categorias/{categoria}', [CategoriaProductoController::class, 'update'])->middleware('can:categorias.update')->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaProductoController::class, 'destroy'])->middleware('can:categorias.destroy')->name('categorias.destroy');

    // Route::resource('categorias', CategoriaProductoController::class);

    //crud categoriaRestaurante
    Route::get('/categoriasRestaurantes', [CategoriaRestauranteController::class, 'index'])->middleware('can:categoriasRestaurantes.index')->name('categoriasRestaurantes.index');
    Route::post('/categoriasRestaurantes', [CategoriaRestauranteController::class, 'store'])->middleware('can:categoriasRestaurantes.store')->name('categoriasRestaurantes.store');
    Route::put('/categoriasRestaurantes/{categoriasRestaurantes}', [CategoriaRestauranteController::class, 'update'])->middleware('can:categoriasRestaurantes.update')->name('categoriasRestaurantes.update');
    Route::delete('/categoriasRestaurantes/{categoriasRestaurantes}', [CategoriaRestauranteController::class, 'destroy'])->middleware('can:categoriasRestaurantes.destroy')->name('categoriasRestaurantes.destroy');

    //productos
    Route::get('/productos/create', [ProductoController::class, 'create'])->middleware('can:productos.index')->name('productos.index');
    Route::post('/productos', [ProductoController::class, 'store'])->middleware('can:productos.store')->name('productos.store');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->middleware('can:productos.update')->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->middleware('can:productos.destroy')->name('productos.destroy');


    //listado restaurantes
    Route::get('/categorias-restaurantes', [ListadoCategoriaRestauranteController::class, 'index'])->middleware('can:categorias.indexlistado')->name('categorias.indexlistado');
    Route::get('/restaurantes-por-categoria/{categoria_id}', [ListadoCategoriaRestauranteController::class, 'restaurantesPorCategoria'])->middleware('can:restaurantes.por-categoria')->name('restaurantes.por-categoria');

    //listado productos
    Route::get('/categorias-producto', [ListadoCategoriaProductoController::class, 'index'])->middleware('can:categoriasProducto.indexlistado')->name('categoriasProducto.indexlistado');
    Route::get('/producto-categoria/{categoria_id}', [ListadoCategoriaProductoController::class, 'productoCategoria'])->middleware('producto.por-categoria')->name('producto.por-categoria');

    //carrito
    Route::post('/agregar-al-pedido/{producto}', [PedidoController::class, 'agregarAlPedido'])->name('agregar-al-pedido');
    Route::get('/carrito-detalles', [PedidoController::class, 'detalles'])->name('carrito.detalles');
    Route::delete('/carrito/eliminar/{detallePedido}', [PedidoController::class, 'eliminarProducto'])->name('carrito.eliminar');
    Route::post('/carrito/actualizar-cantidad/{detalle}', [PedidoController::class, 'actualizarCantidad'])->name('carrito.actualizar-cantidad');

    //Pago
    Route::get('/realizar-pago', [PagoController::class, 'mostrarPago'])->name('realizarPago');

    Route::post('/marcar-pedido-pendiente', [PagoController::class, 'marcarComoPendiente'])->name('marcar.pendiente');

    //historial de pedidos
    Route::get('/pedidos-hechos', [PedidosHechosController::class, 'index'])->name('pedidos-hechos.index');
    //pedidos hechos detalles
    // Route::get('/pedidos-hechos', [PedidosHechosController::class, 'index']);
    Route::get('/pedidos-hechos/detalles/{pedidoId}', [PedidosHechosController::class, 'detalles']);
    // En web.php
    Route::post('/reportar-repartidor', [PedidosHechosController::class, 'reportarRepartidor'])->name('reportar.repartidor');


    //lista usuarios
    Route::get('/usuarios', [UsuariosController::class, 'index'])->middleware('can:usuarios.index')->name('usuarios.index');
    //cambiar estado a activo
    Route::put('/usuarios/toggle-status/{id}', [UsuariosController::class, 'toggleStatus'])->middleware('can:usuarios.toggleStatus')->name('usuarios.toggleStatus');

    //coordenadas
    Route::post('/actualizar-coordenadas/{pedidoId}', [PagoController::class, 'actualizarCoordenadas'])->name('actualizar.coordenadas');

    //rutas para repartidor
    Route::get('/repartidor/mapa', [PedidoRepartidorController::class, 'mostrarMapa'])->middleware('can:pedidosrepartidor.index')->name('pedidosrepartidor.index');
    Route::get('/repartidor/pedidos-pendientes', [PedidoRepartidorController::class, 'pedidosPendientes'])->middleware('can:pedidosrepartidosr.index')->name('pedidosrepartidosr.index');
    Route::post('/repartidor/aceptar-pedido/{pedidoId}', [PedidoRepartidorController::class, 'aceptarPedido'])->middleware('can:repartidor.aceptarPedido')->name('repartidor.aceptarPedido');
    Route::post('/repartidor/cancelar-pedido/{pedidoId}', [PedidoRepartidorController::class, 'cancelarPedido'])->middleware('can:repartidor.detalles')->name('repartidor.detalles');

    Route::get('/reportes', [ReportesController::class, 'index'])->middleware('can:reportes.index')->name('reportes.index');
    Route::get('/reportes/{id}', [ReportesController::class, 'detalle'])->middleware('can:reportes.detalle')->name('reportes.detalle');


    Route::get('/user/{id}', [DetallesUserController::class, 'show'])->name('user.details');
    Route::put('/user/{id}', [DetallesUserController::class, 'toggleStatus'])->name('usuariosreport.toggleStatus');




});

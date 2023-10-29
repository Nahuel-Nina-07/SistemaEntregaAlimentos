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

//redireccion con roles
Route::get('/redirects', [HomeController::class, "index"])->name('redirects');

//datos basicos
Route::get('/ingresar-basicos', [SolicitudTrabajoBasicoController::class, 'index'])->name('repartidor.create');
Route::post('/guardar-basicos', [SolicitudTrabajoBasicoController::class, 'guardarNombreCi'])->name('guardarNombreCi');
Route::get('/ingresar-detallados', [SolicitudTrabajoController::class, 'index']);
Route::post('/guardar-detallados', [SolicitudTrabajoController::class, 'guardarEdadNumero']);

//formulario de registro de restaurante
Route::get('/formRestaurante', function () {
    return view('formSolicitudes.form_restaurante');
})->name('registerRestaurante.form_restaurante');

Route::get('/uneteRestaurante', function () {
    return view('formSolicitudes.form_negocio_uno');
})->name('formSolicitudes.unete_restaurante');

//formulario registro restaurante
Route::get('/ingresar-restaurante', [registroRestauranteController::class, 'index'])->name('registerRestaurante.uneteRestaurante');
Route::post('/guardar-restaurante', [registroRestauranteController::class, 'store']);
Route::get('/formRestaurante', [formRestauranteController::class, 'index']);
Route::post('/guardar-formRestaurante', [formRestauranteController::class, 'store']);

#Plantilla de trabajando en ello
Route::get('/trabajando', function () {
    return view('errors.trabajando');
})->name('trabajando');


//registrar con google
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();
    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ], [
        'name' => $user_google->name,
        'email' => $user_google->email,
    ]);
    Auth::login($user);
    return redirect('/dashboard');
});

//registrar con facebook
Route::get('/auth/redirect', [AuthController::class, 'redirect'])
    ->name('auth.redirect');

Route::get('/auth/callback', [AuthController::class, 'callback'])
    ->name('auth.callback');

    
//ver las solicitudes //Adminitrador
Route::get('/ver-solicitudes-pendientes', [AdminSolicitudTrabajoController::class, 'index'])->name('admin.solicitudes');
Route::get('/solicitudes/{id}', [AdminSolicitudTrabajoController::class, 'show'])->name('solicitudes.show');
Route::post('/solicitudes/{id}', [AdminSolicitudTrabajoController::class, 'show'])->name('solicitudes.show');
Route::get('/solicitudes/aceptadas/{id}', [AdminSolicitudTrabajoController::class,'verSolicitudesAceptadas'])->name('solicitudes.aceptadas');

//restaurantes
Route::get('/ver-solicitudes-pendientes-restaurantes', [AdminSolicitudRestauranteController::class, 'index'])->name('admin.solicitudesRestaurantes');
Route::get('/solicitudes/restaurantes/{id}', [AdminSolicitudRestauranteController::class, 'show'])->name('restaurantes.show');
Route::post('/solicitudes/restaurantes/{id}', [AdminSolicitudRestauranteController::class, 'show'])->name('restaurantes.show');
Route::get('/solicitudes/aceptadas/restaurantes/{id}', [AdminSolicitudRestauranteController::class,'verSolicitudesAceptadas'])->name('restaurantes.aceptados');

//crud categoriaProducto
Route::get('/categorias', [CategoriaProductoController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriaProductoController::class, 'store'])->name('categorias.store');

Route::resource('categorias', CategoriaProductoController::class);

//crud categoriaRestaurante
Route::get('/categoriasRestaurantes', [CategoriaRestauranteController::class, 'index'])->name('categoriasRestaurantes.index');
Route::post('/categoriasRestaurantes', [CategoriaRestauranteController::class, 'store'])->name('categoriasRestaurantes.store');

//productos
Route::get('/productos/create',[ProductoController::class, 'create'])->name('productos.index');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');

Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');


//listado restaurantes
Route::get('/categorias-restaurantes', [ListadoCategoriaRestauranteController::class, 'index'])->name('categorias.indexlistado');
Route::get('/restaurantes-por-categoria/{categoria_id}', [ListadoCategoriaRestauranteController::class, 'restaurantesPorCategoria'])
    ->name('restaurantes.por-categoria');

//listado productos
Route::get('/categorias-producto', [ListadoCategoriaProductoController::class, 'index'])->name('categoriasProducto.indexlistado');
Route::get('/producto-categoria/{categoria_id}', [ListadoCategoriaProductoController::class, 'productoCategoria'])
    ->name('producto.por-categoria');

//carrito
Route::post('/agregar-al-pedido/{producto}', [PedidoController::class, 'agregarProducto'])->name('agregar-al-pedido');


//Ingresar contraseña solicitud
Route::get('/reset-password-copi/{token}', [ResetPasswordCopyController::class, 'showResetForm'])
    ->name('password.reset-copie');
Route::post('/reset-password-copi', [ResetPasswordCopyController::class, 'update'])
    ->name('password.update');

//contraseña por default
Route::get('/forgot-password', [Laravel\Fortify\Http\Controllers\PasswordResetLinkController::class, 'create'])
    ->name('password.request');

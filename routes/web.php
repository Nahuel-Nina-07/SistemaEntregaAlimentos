<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SolicitudTrabajoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitudTrabajoBasicoController;

use App\Http\Controllers\AdminSolicitudRestauranteController;


use App\Http\Controllers\AdminSolicitudTrabajoController;

Route::get('/', function () {
    return view('welcome');
});


//formulario de registro de restaurante
Route::get('/formRestaurante', function () {
    return view('formSolicitudes.form_restaurante');
})->name('registerRestaurante.form_restaurante');

Route::get('/uneteRestaurante', function () {
    return view('formSolicitudes.unete_restaurante');
});

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
Route::post('/guardar-basicos', [SolicitudTrabajoBasicoController::class, 'guardarNombreCi']);

Route::get('/ingresar-detallados', [SolicitudTrabajoController::class, 'index']);
Route::post('/guardar-detallados', [SolicitudTrabajoController::class, 'guardarEdadNumero']);

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
Route::get('/ver-solicitudes-aceptadas', [AdminSolicitudTrabajoController::class, 'aceptados'])->name('admin.solicitudesAceptadas');
Route::get('/ver-solicitudes-rechazadas', [AdminSolicitudTrabajoController::class, 'rechazados'])->name('admin.solicitudesRechazadas');
Route::get('/solicitudes/{id}', [AdminSolicitudTrabajoController::class, 'show'])->name('solicitudes.show');
Route::post('/solicitudes/{id}', [AdminSolicitudTrabajoController::class, 'show'])->name('solicitudes.show');
Route::get('/solicitudes/aceptadas/{id}', [AdminSolicitudTrabajoController::class,'verSolicitudesAceptadas'])->name('solicitudes.aceptadas');
//restaurantes
Route::get('/ver-solicitudes-pendientes-restaurantes', [AdminSolicitudRestauranteController::class, 'index'])->name('admin.solicitudesRestaurantes');


Route::get('/otro', function () {
    return view('otro');
})->name('registerRestaurante.form_restaurante');


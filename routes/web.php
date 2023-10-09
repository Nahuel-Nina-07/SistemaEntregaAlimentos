<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SolicitudTrabajoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitudTrabajoBasicoController;

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
        return view('dashboard');
    })->name('dashboard');
});

//redireccion con roles
Route::get('/redirects', [HomeController::class, "index"])->name('redirects');

// Ruta para mostrar el formulario trabajo
// Route::get('/solicitudes/create', [SolicitudTrabajoController::class, 'create'])->name('repartidor.create');
// Route::post('/solicitudes/store', [SolicitudTrabajoController::class, 'store'])->name('repartidor.store');

// Route::get('/solicitudes/user', function () {
//     return view('formSolicitudes.form_solicitud_trabajo_uno');
// })->name('repartidor_uno.create');


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
    // $user->token
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
Route::get('/ver-solicitudes', [SolicitudTrabajoController::class, 'index'])->name('solicitudes.index');
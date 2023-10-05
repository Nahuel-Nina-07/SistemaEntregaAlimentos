<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SolicitudTrabajoController;


Route::get('/', function () {
    return view('welcome');
});


//formulario de registro de restaurante
Route::get('/formRestaurante', function () {
    return view('registerRestaurante.form_restaurante');
})->name('registerRestaurante.form_restaurante');

Route::get('/uneteRestaurante', function () {
    return view('registerRestaurante.unete_restaurante');
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

// Ruta para mostrar el formulario trabajo
Route::get('/solicitudes/create', [SolicitudTrabajoController::class, 'create'])->name('repartidor.create');
Route::post('/solicitudes/store', [SolicitudTrabajoController::class, 'store'])->name('repartidor.store');

#Plantilla de trabajando en ello
Route::get('/trabajando', function () {
    return view('errors.trabajando');
})->name('trabajando');








Route::get('/restaurante', function () {
    return view('Restaurante.restaurante');
})->name('restaurante');

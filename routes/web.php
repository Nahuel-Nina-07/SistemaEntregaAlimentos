<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
USE App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SolicitudTrabajoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google= Socialite::driver('google')->stateless()->user();

    // $user->token
    $user=User::updateOrCreate([
        'google_id'=>$user_google->id,
    ],[
        'name'=>$user_google->name,
        'email'=>$user_google->email,
    ]);
    Auth::login($user);
    return redirect('/dashboard');
    
});


Route::get('/formulario', function () {
    return view('Repartidor.form');
})->name('formulario');

Route::get('/restaurante', function () {
    return view('Restaurante.restaurante');
})->name('restaurante');


#Plantilla de trabajando en ello
Route::get('/trabajando', function () {return view('errors.trabajando');})->name('trabajando');
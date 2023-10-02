<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlimentoController;

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
    return view('auth.loginform');
});

Route::middleware('admin:admin')->group(function (){
    Route::get('admin/login',[AdminController::class, 'loginForm']);
    Route::post('admin/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dash.index');
    })->name('dash')->middleware('auth:admin');
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


Route::group(['prefix' => 'alimentos'], function () {
    Route::get('/ver', [AlimentoController::class, 'index']);
    Route::post('/crear', [AlimentoController::class, 'store']);
    Route::put('/actualizar/{id}', [AlimentoController::class, 'update']);
    Route::delete('/eliminar/{id}', [AlimentoController::class, 'destroy']);
});

Route::middleware('admin:admin')->group(function (){
    Route::get('admin/login',[AdminController::class, 'loginForm']);
    Route::post('admin/login',[AdminController::class, 'store'])->name('admin.login');
    
    // Ruta para mostrar el formulario de registro de administradores
    Route::get('admin/register',[AdminController::class, 'showAdminRegistrationForm']);
    
    // Ruta para procesar el registro de administradores
    Route::post('admin/register',[AdminController::class, 'createAdmin'])->name('admin.register');
});

Route::get('/trabajando', function () {return view('errors.trabajando');})->name('trabajando');
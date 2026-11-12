<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckAdmin;

/*
|--------------------------------------------------------------------------
| Fase 3: Rutas Públicas (Acceso Libre)
|--------------------------------------------------------------------------
| /, /login y /register son accesibles por cualquier visitante sin restricciones.
*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/login/simulate', [AuthController::class, 'simulate'])->name('login.simulate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| Fase 3: Rutas Privadas (Protegidas por Middlewares / Porteros)
|--------------------------------------------------------------------------
*/

// Middleware de Autenticación (CheckAuth):
// Comprueba si el usuario está autenticado. Si no, redirige a /login.
Route::middleware(['checkAuth'])->group(function () {

    // /panel: protegida ÚNICAMENTE por el middleware de autenticación
    Route::get('/panel', function () {
        return view('panel-usuario');
    })->name('panel');

    // /casino: protegida por CheckAuth y por CheckAge (edad >= 18)
    Route::middleware(['checkAge'])->group(function () {
        Route::get('/casino', function () {
            return view('casino');
        })->name('casino');
    });

    // /admin: protegida por CheckAuth y por CheckAdmin (is_admin = true)
    Route::middleware(['checkAdmin'])->group(function () {
        Route::get('/admin', function () {
            return view('panel-admin');
        })->name('admin');
    });

});

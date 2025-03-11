<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PapeleriaController;

// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rutas protegidas para todos los usuarios autenticados
Route::middleware('auth:api')->group(function () {
    // Rutas de autenticación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    
    // Rutas de papelería para cualquier usuario autenticado
    Route::prefix('papeleria')->group(function () {
        Route::get('/', [PapeleriaController::class, 'index']);
        Route::get('/{id}', [PapeleriaController::class, 'show']);
    });
});

// Rutas exclusivas para administradores
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::prefix('papeleria')->group(function () {
        Route::post('/', [PapeleriaController::class, 'store']);
        Route::put('/{id}', [PapeleriaController::class, 'update']);
        Route::delete('/{id}', [PapeleriaController::class, 'destroy']);
    });
});

// Rutas exclusivas para usuarios regulares
Route::middleware(['auth:api', 'role:user'])->group(function () {
    Route::post('papeleria', [PapeleriaController::class, 'store']); // Solo pueden agregar
});

Route::get('/prueba', function () {
    return "Esta ruta funciona correctamente";
});
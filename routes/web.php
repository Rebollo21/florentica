<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Models\Comment;
use App\Models\Producto;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| 🔓 RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $productos = Producto::all();
    $comments = Comment::where('stars', '>=', 3)->where('approved', 1)->latest()->take(6)->get();
    return view('welcome', compact('productos', 'comments'));
})->name('welcome');

// Autenticación y Registro
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::get('/join-delivery', function () { return view('auth.delivery-register'); })->name('register.delivery');
Route::post('/register', [AuthController::class, 'register']);

// Recuperación de Contraseña
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| 🛡️ RUTAS PROTEGIDAS (Auth + Verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

   // --- ZONA ADMINISTRADOR (Rectoría) ---
Route::middleware(['role:admin'])->group(function () {
    
    // 1. Dashboard Principal
    Route::get('/admin/dashboard', function () {
        $usuarios = \App\Models\User::all();
        $insumos = \App\Models\Insumo::with('lotes')->get();
        return view('admin.dashboard', compact('usuarios', 'insumos'));
    })->name('admin.dashboard');

    // 2. Gestión del Catálogo (Insumos)
    Route::get('/admin/insumos/nuevo', [InsumoController::class, 'create'])->name('insumos.create');
    Route::post('/admin/insumos/guardar', [InsumoController::class, 'store'])->name('insumos.store');

    // 3. Gestión de Lotes (Entradas de Mercancía)
    Route::get('/admin/lotes/nuevo', [LoteController::class, 'create'])->name('lotes.create');
    Route::post('/admin/lotes', [LoteController::class, 'store'])->name('lotes.store');
    
    // ✨ EL CEREBRO DE GEMINI (Nueva Ruta de IA)
    // Esta ruta es la que llama el JavaScript de tu formulario
    Route::get('/admin/ia/sugerir-precio', [LoteController::class, 'sugerirPrecioIA'])->name('ia.sugerir');

    // 4. Gestión de Productos (Ramos Finales)
    Route::get('/admin/productos/nuevo', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/admin/productos/guardar', [ProductoController::class, 'store'])->name('productos.store');
});

    

    // --- ZONA REPARTIDOR ---
    Route::middleware(['role:delivery'])->group(function () {
        Route::get('/delivery/dashboard', function () {
            return view('delivery.index');
        })->name('delivery.index');
    });

    // --- ZONA CLIENTE (Shop) ---
    Route::middleware(['role:buyer'])->group(function () {
        Route::get('/shop', [ProductoController::class, 'index'])->name('shop.index');
        Route::get('/shop/producto/{id}', [ProductoController::class, 'show'])->name('shop.show');
        Route::get('/profile', function () { return view('client.profile'); })->name('client.profile');
        Route::post('/comentarios', [CommentController::class, 'store'])->name('comments.store');
    });

});

/*
|--------------------------------------------------------------------------
| 📧 VERIFICACIÓN DE EMAIL
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('shop.index'); 
})->middleware(['auth', 'signed'])->name('verification.verify');
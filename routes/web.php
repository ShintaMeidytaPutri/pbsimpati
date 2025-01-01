<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('home');
Route::get('/booking', [App\Http\Controllers\PageController::class, 'booking'])->name('booking');
Route::post('/booking', [App\Http\Controllers\PageController::class, 'booking_action'])->name('booking.action');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login_action'])->name('login.action');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/tambah-booking', [App\Http\Controllers\AdminController::class, 'tambah_booking'])->name('admin.booking.tambah');
    Route::prefix('api')->group(function () {
        Route::post('/booking', [App\Http\Controllers\AdminController::class, 'add_booking'])->name('api.booking.add');
        Route::put('/booking/{id}', [App\Http\Controllers\AdminController::class, 'update_booking'])->name('api.booking.update');
        Route::delete('/booking/{id}', [App\Http\Controllers\AdminController::class, 'delete_booking'])->name('api.booking.delete');
    });

    
    
});

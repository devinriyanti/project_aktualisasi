<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('auth/login');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', fn() => redirect('/buku-tamu'));

Route::get('/buku-tamu', [GuestController::class, 'form'])->name('guests.form');
Route::post('/buku-tamu', [GuestController::class, 'store'])->name('guests.store');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::get('/admin/guests/export', [GuestController::class, 'exportPdf'])->name('guests.export');
});

require __DIR__.'/auth.php';

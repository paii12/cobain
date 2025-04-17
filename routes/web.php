<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

// Home Route
Route::get('/', function () {
    return view('login');
});

Auth::routes(); // Rute autentikasi otomatis

// Rute untuk dashboard
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// CRUD User    
Route::resource('user', UserController::class);

// Rute untuk wallet
Route::post('/topUp', [WalletController::class, 'topup'])->name('topUp');
Route::post('/acceptRequest', [WalletController::class, 'acceptRequest'])->name('acceptRequest');
Route::post('/withdraw', [WalletController::class, 'withdraw'])->name('withdraw');
Route::post('/transfer', [WalletController::class, 'transfer'])->name('transfer');

// Rute untuk admin
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::post('/add-user', [UserController::class, 'store'])->name('add-user');
    Route::get('add-user', [UserController::class, 'create'])->name('add-user');
    Route::post('store-user', [UserController::class, 'store'])->name('store-user');
    Route::get('edit-user/{user}', [UserController::class, 'edit'])->name('edit-user');
    Route::put('update-user/{user}', [UserController::class, 'update'])->name('update-user');
    Route::delete('delete-user/{user}', [UserController::class, 'destroy'])->name('delete-user');
});

Route::post('/approve/{wallet}', [WalletController::class, 'acceptRequest'])
    ->name('approve')
    ->middleware('role:bank'); // Middleware role untuk pengguna 'bank'

Route::post('/reject/{wallet}', [WalletController::class, 'rejectRequest'])
    ->name('reject')
    ->middleware('role:bank'); // Middleware role untuk pengguna 'bank'

    Route::post('/topup.siswa[', [WalletController::class, 'topupsiswa'])->name('topup.siswa');

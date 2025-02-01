<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Redirect ke daftar barang
Route::get('/', function () {
    return redirect()->route('barangs.index');
});

// Route Barang (User)
Route::get('barangs/{id}', [BarangController::class, 'show'])->name('barangs.show');

// Route Penawaran
Route::post('barangs/{barang}/penawarans', [PenawaranController::class, 'store'])
    ->middleware('auth', 'throttle:10,1')
    ->name('penawarans.store');
    Route::get('/barang/{barang}/penawaran', [PenawaranController::class, 'create'])->name('barangs.tawar');
    
// Routes untuk User
Route::get('/barangs', [BarangController::class, 'index'])->name('barangs.index');
Route::post('/barangs/{id}/bid', [BarangController::class, 'bid'])->name('barangs.bid');
Route::get('/barangs/barangsdash', [BarangController::class, 'dashboard'])->name('barangs.dashboard')->middleware('auth');
Route::get('/barangs/penawaran-saya', [PenawaranController::class, 'index'])->name('penawaran.saya');

// Routes untuk Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

// Route Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'process']);

// Route Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index'])
        ->middleware('admin')
        ->name('admin.dashboard');
});

// route tawar
Route::post('/penawarans', [PenawaranController::class, 'store'])->name('penawaran.store');

// route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

//route manage user
Route::get('/manage-user', [UserController::class, 'index'])->name('manage.user');
Route::post('/manage-user/update-password/{id}', [UserController::class, 'updatePassword'])->name('update.password');


//profile
Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');



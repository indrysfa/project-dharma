<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PengabdianController;
use App\Http\Controllers\PengajaranController;
use App\Http\Controllers\PengembanganController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/')->middleware('auth')->middleware('verified')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/forgot-password', [UserController::class, 'forgotPassword'])->name('dosen.forgot-password');
    Route::get('/dosen', [UserController::class, 'dosen'])->name('dosen.index');

    Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/user/add', [UserController::class, 'create'])->name('user.create');

    Route::get('/user-detail/{user}', [UserController::class, 'detail'])->name('user.detail');
    Route::get('/user-edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user-edit/{user}', [UserController::class, 'update'])->name('user.update');

    Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/periode', [PeriodeController::class, 'index'])->name('periode.index');
    Route::get('/periode/add', [PeriodeController::class, 'create'])->name('periode.add');
    Route::post('/periode/add', [PeriodeController::class, 'store'])->name('periode.create');
    Route::delete('/periode/delete/{periode}', [PeriodeController::class, 'destroy'])->name('periode.delete');

    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::get('/penugasan/add', [PenugasanController::class, 'create'])->name('penugasan.add');
    Route::post('/penugasan/add', [PenugasanController::class, 'store'])->name('penugasan.create');

    Route::get('/pengajaran', [PengajaranController::class, 'index'])->name('pengajaran.index');
    Route::get('/pengajaran/add', [PengajaranController::class, 'add'])->name('pengajaran.add');
    Route::post('/pengajaran/add', [PengajaranController::class, 'create'])->name('pengajaran.create');
    Route::get('/pengajaran-edit/{pengajaran}', [PengajaranController::class, 'edit'])->name('pengajaran.edit');
    Route::put('/pengajaran-edit/{pengajaran}', [PengajaranController::class, 'update'])->name('pengajaran.update');
    Route::delete('/pengajaran/delete/{pengajaran}', [PengajaranController::class, 'destroy'])->name('pengajaran.delete');

    Route::get('/penelitian', [PenelitianController::class, 'index'])->name('penelitian.index');
    Route::get('/penelitian/add', [PenelitianController::class, 'create'])->name('penelitian.add');
    Route::post('/penelitian/add', [PenelitianController::class, 'store'])->name('penelitian.create');
    Route::get('/penelitian-edit/{penelitian}', [PenelitianController::class, 'edit'])->name('penelitian.edit');
    Route::put('/penelitian-edit/{penelitian}', [PenelitianController::class, 'update'])->name('penelitian.update');
    Route::delete('/penelitian/delete/{penelitian}', [PenelitianController::class, 'destroy'])->name('penelitian.delete');

    Route::get('/pengabdian', [PengabdianController::class, 'index'])->name('pengabdian.index');
    Route::get('/pengabdian/add', [PengabdianController::class, 'create'])->name('pengabdian.add');
    Route::post('/pengabdian/add', [PengabdianController::class, 'store'])->name('pengabdian.create');
    Route::get('/pengabdian-edit/{pengabdian}', [PengabdianController::class, 'edit'])->name('pengabdian.edit');
    Route::put('/pengabdian-edit/{pengabdian}', [PengabdianController::class, 'update'])->name('pengabdian.update');
    Route::delete('/pengabdian/delete/{pengabdian}', [PengabdianController::class, 'destroy'])->name('pengabdian.delete');

    Route::get('/pengembangan', [PengembanganController::class, 'index'])->name('pengembangan.index');
    Route::get('/pengembangan/add', [PengembanganController::class, 'create'])->name('pengembangan.add');
    Route::post('/pengembangan/add', [PengembanganController::class, 'store'])->name('pengembangan.create');
    Route::get('/pengembangan-edit/{pengembangan}', [PengembanganController::class, 'edit'])->name('pengembangan.edit');
    Route::put('/pengembangan-edit/{pengembangan}', [PengembanganController::class, 'update'])->name('pengembangan.update');
    Route::delete('/pengembangan/delete/{pengembangan}', [PengembanganController::class, 'destroy'])->name('pengembangan.delete');
});

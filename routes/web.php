<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
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

    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/add', [DosenController::class, 'add'])->name('dosen.add');
    Route::post('/dosen/add', [DosenController::class, 'create'])->name('dosen.create');
    Route::get('/dosen-detail/{dosen}', [DosenController::class, 'detail'])->name('dosen.detail');
    Route::get('/dosen-edit/{dosen}', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen-edit/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/delete/{dosen}', [DosenController::class, 'destroy'])->name('dosen.delete');

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
    Route::get('/pengajaran/report', [PengajaranController::class, 'report'])->name('pengajaran.report');
    Route::get('/pengajaran/export', [PengajaranController::class, 'export'])->name('pengajaran.export');
    Route::get('/pengajaran/generate-pdf/{id}', [PengajaranController::class, 'generatePDF'])->name('pengajaran.pdf');

    Route::get('/penelitian', [PenelitianController::class, 'index'])->name('penelitian.index');
    Route::get('/penelitian/add', [PenelitianController::class, 'create'])->name('penelitian.add');
    Route::post('/penelitian/add', [PenelitianController::class, 'store'])->name('penelitian.create');
    Route::get('/penelitian-edit/{penelitian}', [PenelitianController::class, 'edit'])->name('penelitian.edit');
    Route::put('/penelitian-edit/{penelitian}', [PenelitianController::class, 'update'])->name('penelitian.update');
    Route::delete('/penelitian/delete/{penelitian}', [PenelitianController::class, 'destroy'])->name('penelitian.delete');
    Route::get('/penelitian/report', [PenelitianController::class, 'report'])->name('penelitian.report');
    Route::get('/penelitian/export', [PenelitianController::class, 'export'])->name('penelitian.export');
    Route::get('/penelitian/generate-pdf/{id}', [PenelitianController::class, 'generatePDF'])->name('penelitian.pdf');

    Route::get('/pengabdian', [PengabdianController::class, 'index'])->name('pengabdian.index');
    Route::get('/pengabdian/add', [PengabdianController::class, 'create'])->name('pengabdian.add');
    Route::post('/pengabdian/add', [PengabdianController::class, 'store'])->name('pengabdian.create');
    Route::get('/pengabdian-edit/{pengabdian}', [PengabdianController::class, 'edit'])->name('pengabdian.edit');
    Route::put('/pengabdian-edit/{pengabdian}', [PengabdianController::class, 'update'])->name('pengabdian.update');
    Route::delete('/pengabdian/delete/{pengabdian}', [PengabdianController::class, 'destroy'])->name('pengabdian.delete');
    Route::get('/pengabdian/report', [PengabdianController::class, 'report'])->name('pengabdian.report');
    Route::get('/pengabdian/export', [PengabdianController::class, 'export'])->name('pengabdian.export');
    Route::get('/pengabdian/generate-pdf/{id}', [PengabdianController::class, 'generatePDF'])->name('pengabdian.pdf');

    Route::get('/pengembangan', [PengembanganController::class, 'index'])->name('pengembangan.index');
    Route::get('/pengembangan/add', [PengembanganController::class, 'create'])->name('pengembangan.add');
    Route::post('/pengembangan/add', [PengembanganController::class, 'store'])->name('pengembangan.create');
    Route::get('/pengembangan-edit/{pengembangan}', [PengembanganController::class, 'edit'])->name('pengembangan.edit');
    Route::put('/pengembangan-edit/{pengembangan}', [PengembanganController::class, 'update'])->name('pengembangan.update');
    Route::delete('/pengembangan/delete/{pengembangan}', [PengembanganController::class, 'destroy'])->name('pengembangan.delete');
    Route::get('/pengembangan/report', [PengembanganController::class, 'report'])->name('pengembangan.report');
    Route::get('/pengembangan/export', [PengembanganController::class, 'export'])->name('pengembangan.export');
    Route::get('/pengembangan/generate-pdf/{id}', [PengembanganController::class, 'generatePDF'])->name('pengembangan.pdf');
});

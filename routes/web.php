<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/a', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/dosen', [UserController::class, 'dosen'])->name('dosen.index');

    Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/user/add', [UserController::class, 'create'])->name('user.create');

    Route::get('/user-detail/{user}', [UserController::class, 'detail'])->name('user.detail');
    Route::get('/user-edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user-edit/{user}', [UserController::class, 'update'])->name('user.update');

    Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/periode', [PeriodeController::class, 'index'])->name('periode.index');
    Route::get('/periode/add', [PeriodeController::class, 'add'])->name('periode.add');
    Route::post('/periode/add', [PeriodeController::class, 'create'])->name('periode.create');
    Route::delete('/periode/delete/{periode}', [PeriodeController::class, 'destroy'])->name('periode.delete');
});

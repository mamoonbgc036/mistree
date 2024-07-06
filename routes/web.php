<?php

use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\SessionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Service\CategoryController;
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

Route::get('/', function () {
    return view('sessions.login');
});

// Backend

Route::get('login', [SessionController::class, 'login'])->name('login');
Route::post('login', [SessionController::class, 'store']);
Route::post('logout', [SessionController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'store']);


Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'store']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('category/{ServiceCategory}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
});
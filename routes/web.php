<?php

use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\SessionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Service\CategoryController;
use App\Http\Controllers\Service\ServiceAreaController;
use App\Http\Controllers\Service\ServiceController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

// http://127.0.0.1:8000/dashboard/service/create dashboard/service/create

Route::get('login', [SessionController::class, 'login'])->name('login');
Route::post('login', [SessionController::class, 'store']);
Route::post('logout', [SessionController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'store']);


Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //category http://127.0.0.1:8000/dashboard/service/create http://127.0.0.1:8000/dashboard/service/edit/15
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'store']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('category/{ServiceCategory}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');

    // service
    Route::get('service', [ServiceController::class, 'index'])->name('service');
    Route::get('service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::patch('service/edit/{id}', [ServiceController::class, 'update']);
    Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('service/create', [ServiceController::class, 'store']);
    Route::delete('service/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
    Route::patch('service/approve/{id}', [ServiceController::class, 'approve_service'])->name('service-approve');
    Route::get('get-thanas/{id}', [ServiceAreaController::class, 'index'])->name('get-thana');
    Route::get('get-unions/{id}', [ServiceAreaController::class, 'unions'])->name('get-unions');
});
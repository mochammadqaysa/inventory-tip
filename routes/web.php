<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TiaraAuth;
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

Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::get('/services', [LandingPageController::class, 'services'])->name('landing.services');
Route::get('/portofolio', [LandingPageController::class, 'portofolio'])->name('landing.portofolio');
Route::get('/about', [LandingPageController::class, 'about'])->name('landing.about');
Route::get('/contacts', [LandingPageController::class, 'contacts'])->name('landing.contacts');


Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login_process', [AuthController::class, 'login_process'])->name('auth.login_process');

Route::prefix('inventory')->middleware(TiaraAuth::class)->group(function () {
    Route::resources(['user' => UserController::class]);
    Route::resources(['role' => RoleController::class]);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.inventory');
    Route::get('/backup_data', [BackupDataController::class, 'index'])->name('backup_data.index');
    Route::post('/upload', [BackupDataController::class, 'upload'])->name('dashboard.upload');

    Route::prefix('select2')->group(function () {
        Route::get('/role', [RoleController::class, 'select2'])->name('select2.role');
    });
});

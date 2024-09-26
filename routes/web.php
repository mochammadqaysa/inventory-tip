<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupDataController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\BahanKeluarController;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\BahanMasukItemController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangMasukItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\JenisWasteController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\WasteKeluarController;
use App\Http\Controllers\WasteMasukController;
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
    Route::resources(['bahan' => BahanController::class]);
    Route::resources(['barang' => BarangController::class]);
    Route::resources(['jenis-waste' => JenisWasteController::class]);
    Route::resources(['waste' => WasteController::class]);
    Route::resources(['supplier' => SupplierController::class]);
    Route::resources(['customer' => CustomerController::class]);
    Route::resources(['gudang' => GudangController::class]);
    Route::resources(['bagian' => BagianController::class]);
    Route::resources(['bahan-masuk' => BahanMasukController::class]);
    Route::resources(['bahan-keluar' => BahanKeluarController::class]);
    Route::resources(['barang-masuk' => BarangMasukController::class]);
    Route::resources(['barang-keluar' => BarangKeluarController::class]);
    Route::resources(['waste-masuk' => WasteMasukController::class]);
    Route::resources(['waste-keluar' => WasteKeluarController::class]);

    Route::post('/info_bahan', [BahanController::class, 'info_bahan'])->name('bahan.info');
    Route::post('/info_barang', [BarangController::class, 'info_barang'])->name('barang.info');
    Route::get('/form_profile', [UserController::class, 'edit_profile'])->name('form.profile');
    Route::get('/form_password', [UserController::class, 'form_password'])->name('password.profile');
    Route::put('/update_profile/{uid}', [UserController::class, 'update_profile'])->name('update.profile');
    Route::put('/profile/change_password/{uid}', [UserController::class, 'change_password'])->name('changepass.profile');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.inventory');
    Route::get('/backup-data', [BackupDataController::class, 'index'])->name('backup-data.index');
    Route::post('/upload', [BackupDataController::class, 'upload'])->name('backup-data.upload');

    Route::prefix('select2')->group(function () {
        Route::get('/role', [RoleController::class, 'select2'])->name('select2.role');
        Route::get('/supplier', [SupplierController::class, 'select2'])->name('select2.supplier');
        Route::get('/customer', [CustomerController::class, 'select2'])->name('select2.customer');
    });
});

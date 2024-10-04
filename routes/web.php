<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupDataController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\BahanKeluarController;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
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

    Route::prefix('report')->group(function () {
        Route::get('/bahan-masuk', [BahanMasukController::class, 'report'])->name('report.bahan-masuk');
        Route::get('/bahan-masuk/result', [BahanMasukController::class, 'result_report'])->name('result-report.bahan-masuk');
        Route::post('/bahan-masuk/excel', [BahanMasukController::class, 'excel_report'])->name('excel-report.bahan-masuk');

        Route::get('/bahan-keluar', [BahanKeluarController::class, 'report'])->name('report.bahan-keluar');
        Route::get('/bahan-keluar/result', [BahanKeluarController::class, 'result_report'])->name('result-report.bahan-keluar');
        Route::post('/bahan-keluar/excel', [BahanKeluarController::class, 'excel_report'])->name('excel-report.bahan-keluar');

        Route::get('/bdp', [BarangKeluarController::class, 'bdp'])->name('report.bdp');
        Route::get('/bdp/result', [BarangKeluarController::class, 'bdp_result_report'])->name('result-report.bdp');
        Route::post('/bdp/excel', [BarangKeluarController::class, 'bdp_excel_report'])->name('excel-report.bdp');

        Route::get('/barang-masuk', [BarangMasukController::class, 'report'])->name('report.barang-masuk');
        Route::get('/barang-masuk/result', [BarangMasukController::class, 'result_report'])->name('result-report.barang-masuk');
        Route::post('/barang-masuk/excel', [BarangMasukController::class, 'excel_report'])->name('excel-report.barang-masuk');

        Route::get('/barang-keluar', [BarangKeluarController::class, 'report'])->name('report.barang-keluar');
        Route::get('/barang-keluar/result', [BarangKeluarController::class, 'result_report'])->name('result-report.barang-keluar');
        Route::post('/barang-keluar/excel', [BarangKeluarController::class, 'excel_report'])->name('excel-report.barang-keluar');
    });

    Route::prefix('select2')->group(function () {
        Route::get('/role', [RoleController::class, 'select2'])->name('select2.role');
        Route::get('/supplier', [SupplierController::class, 'select2'])->name('select2.supplier');
        Route::get('/customer', [CustomerController::class, 'select2'])->name('select2.customer');
    });
});

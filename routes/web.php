<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\kasirPoliController;
use App\Http\Controllers\kasirPoliklinik;
use App\Http\Controllers\masterFarmasiController;
use App\Http\Controllers\mastersatuController;
use App\Http\Controllers\poDoController;
use App\Http\Controllers\registrasiController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\WilayahController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/antrian', [HomeController::class, 'antrian']);

// RM SEARCH
Route::controller(HomeController::class)->group(function () {
    Route::get('registrasi', 'registrasi');
    Route::get('registrasiView', 'registrasiView')->name('registrasiView');
    Route::get('data-sosial', 'dasos');
    Route::get('registrasiSearch', 'registrasiSearch')->name('registrasiSearch');
    Route::get('getDasos/{fs_mr}', 'getDasos')->name('getDasos');
    Route::get('getLayananMedis/{id_layanan}', 'getLayananMedis')->name('getLayananMedis');
});

// REG + DASOS CREATE,EDIT DELETE
Route::controller(registrasiController::class)->group(function () {
    Route::post('create-registrasi', 'registrasiCreate')->name('create-registrasi');
    Route::post('edit-registrasi', 'editRegister')->name('edit-registrasi');
    Route::post('create-dasos', 'store')->name('create-dasos');
    Route::post('edit-dasos', 'editDasos')->name('edit-dasos');
    Route::get('delete-dasos', 'deleteDasos')->name('delete-dasos');
});


// MSTR SATU GET
Route::controller(mastersatuController::class)->group(function () {
    Route::get('mstr-layanan', 'layanan')->name('layanan');
    Route::get('mstr-medis', 'medis')->name('medis');
    Route::get('mstr-jaminan', 'jaminan')->name('jaminan');
    Route::get('mstr-tindakan', 'tindakan')->name('tindakan');
    Route::get('mstr-nilai-tindakan', 'nilaiTindakan')->name('nilai-tindakan');
});

// MSTR SATU POST
Route::controller(mastersatuController::class)->group(function () {
    Route::post('add-mstr-layanan', 'layananCreate')->name('add-mstr-layanan');
    Route::post('add-mstr-medis', 'DokterCreate')->name('add-mstr-medis');
    Route::post('add-mstr-jaminan', 'jaminanCreate')->name('add-mstr-jaminan');
    Route::post('add-mstr-tindakan', 'tindakanCreate')->name('add-mstr-tindakan');
    Route::post('add-mstr-nilai-tindakan', 'nilaiTindakanCreate')->name('add-mstr-nilai-tindakan');
});

// VIEW AFTER POST
Route::controller(mastersatuController::class)->group(function () {
    Route::get('view-mstr-layanan', 'viewLayanan')->name('view-mstr-layanan');
    Route::get('view-mstr-medis', 'medis')->name('view-mstr-medis');
    Route::get('view-mstr-jaminan', 'jaminan')->name('view-mstr-jaminan');
    Route::get('view-mstr-tindakan', 'tindakan')->name('view-mstr-tindakan');
});


Route::controller(TindakanController::class)->group(function () {
    Route::get('tindakan-medis', 'tindakanMedis')->name('tindakan-medis');
    Route::get('SearchRegister/{kdReg}', 'registerSearch')->name('SearchRegister');
    Route::get('getTimeline/{mr}', 'getTimeline')->name('getTimeline');
    Route::get('getTimelineTdk/{mr}', 'getTimelineTdk')->name('getTimelineTdk');
    Route::get('getLastID', 'getLastID')->name('getLastID');
    Route::post('chartCreate', 'chartCreate')->name('chartCreate');
});


// VIEW MSTR FARMASI
Route::controller(masterFarmasiController::class)->group(function () {
    Route::get('mstr-kategori-produk', 'katProd')->name('mstr-kategori-produk');
    Route::get('mstr-satuan', 'satuan')->name('mstr-satuan');
    Route::get('mstr-lokasi-stock', 'lokStock')->name('mstr-lokasi-stock');
    Route::get('mstr-jenis-obat', 'jenBat')->name('mstr-jenis-obat');
    Route::get('mstr-supplier', 'supplier')->name('mstr-supplier');
    Route::get('mstr-obat', 'obat')->name('mstr-Obat');
});

// CREATE MSTR FARMASI
Route::controller(masterFarmasiController::class)->group(function () {
    Route::post('add-mstr-kategori-produk', 'katProdCreate')->name('add-mstr-kategori-produk');
    Route::post('add-mstr-satuan', 'satuanCreate')->name('add-mstr-satuan');
    Route::post('add-mstr-lokasi-stock', 'lokstockCreate')->name('add-mstr-lokasi-stock');
    Route::post('add-mstr-jenis-obat', 'jenBatCreate')->name('add-mstr-jenis-obat');
    Route::post('add-mstr-supplier', 'supplierCreate')->name('add-mstr-supplier');
    Route::post('add-mstr-obat', 'obatCreate')->name('add-mstr-obat');
});

// DELETE MSTR FARMASI
Route::controller(masterFarmasiController::class)->group(function () {
    Route::delete('destroy-mstr-kategori-produk/{id}', 'katProdCreate')->name('destroy-mstr-kategori-produk');
    Route::delete('destroy-mstr-satuan/{id}', 'satuanDestroy')->name('destroy-mstr-satuan');
    Route::delete('destroy-mstr-lokasi-stock/{id}', 'lokStockDestroy')->name('destroy-mstr-lokasi-stock');
    Route::delete('destroy-mstr-jenis-obat/{id}', 'jenBatDestroy')->name('destroy-mstr-jenis-obat');
    Route::delete('destroy-mstr-supplier/{id}', 'supplier')->name('destroy-mstr-supplier');
    Route::delete('destroy-mstr-obat/{id}', 'obat')->name('destroy-mstr-Obat');
    // Route::post('/create-dasos', [registrasiController::class, 'store']);
});

// VIEW PO-DO
Route::controller(poDoController::class)->group(function () {
    Route::get('purchase-order', 'po')->name('purchase-order');
    Route::get('delivery-order', 'do')->name('delivery-order');
    Route::get('obatSearch', 'obatSearch')->name('obatSearch');
    Route::get('getObatList/{obat}', 'getObatList')->name('getObatList');
});

// CREATE PO-DO
Route::controller(poDoController::class)->group(function () {
    Route::post('add-delivery-order', 'doCreate')->name('add-delivery-order');
});

// VIEW TRS-KASIR-POLI
Route::controller(kasirPoliController::class)->group(function () {
    Route::get('kasir-poli', 'kasirPoli')->name('kasir-poli');
    Route::get('SearchRegisterKsr/{kdReg}', 'xregisterSearch')->name('SearchRegisterKsr');

    Route::get('kasir-apotek', 'kasirApotek')->name('kasir-apotek');
    Route::post('regout', 'regOut')->name('regout');
});


//Wilayah
Route::controller(WilayahController::class)->group(function () {
    Route::get('provinces', 'provinces')->name('provinces');
    Route::get('cities', 'cities')->name('cities');
    Route::get('districts', 'districts')->name('districts');
    Route::get('villages', 'villages')->name('villages');
});

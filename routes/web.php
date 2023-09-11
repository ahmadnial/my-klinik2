<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\mastersatuController;
use App\Http\Controllers\registrasiController;

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

Route::get('/data-sosial', [HomeController::class, 'dasos']);
Route::get('/antrian', [HomeController::class, 'antrian']);

// RM SEARCH
Route::controller(HomeController::class)->group(function () {
    Route::get('registrasi', 'registrasi');
    Route::get('registrasiSearch', 'registrasiSearch')->name('registrasiSearch');
    Route::get('getDasos/{fs_mr}', 'getDasos')->name('getDasos');
});

// MSTR SATU GET
Route::controller(mastersatuController::class)->group(function () {
    Route::get('mstr-layanan', 'layanan')->name('layanan');
    Route::get('mstr-medis', 'medis')->name('meids');
    Route::get('mstr-jaminan', 'jaminan')->name('jaminan');
});

// MSTR SATU POST
Route::controller(mastersatuController::class)->group(function () {
    Route::post('add-mstr-layanan', 'layananCreate')->name('add-mstr-layanan');
    Route::post('add-mstr-medis', 'DokterCreate')->name('add-mstr-medis');
    Route::get('mstr-jaminan', 'jaminan')->name('jaminan');
});

// VIEW AFTER POST
Route::controller(mastersatuController::class)->group(function () {
    Route::get('view-mstr-layanan', 'viewLayanan')->name('view-mstr-layanan');
    Route::get('mstr-medis', 'medis')->name('meids');
    Route::get('mstr-jaminan', 'jaminan')->name('jaminan');
});

Route::post('/create-dasos', [registrasiController::class, 'store']);

Route::get('/registrasi', [HomeController::class, 'registrasi']);

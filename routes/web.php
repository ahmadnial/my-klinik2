<?php

use App\Http\Controllers\aktifasiRegisterController;
use App\Http\Controllers\analisaController;
use App\Http\Controllers\arsipController;
use App\Http\Controllers\AssesmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\kasirPoliController;
use App\Http\Controllers\kasirPoliklinik;
use App\Http\Controllers\LapFarmasiController;
use App\Http\Controllers\masterFarmasiController;
use App\Http\Controllers\mastersatuController;
use App\Http\Controllers\penjualanController;
use App\Http\Controllers\poDoController;
use App\Http\Controllers\registrasiController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HutangSupplierController;
use App\Http\Controllers\lapAccountingController;
use App\Http\Controllers\lookUpController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\trsLabController;

// Route::group(['middleware' => 'guest'], function () {
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/ProsesLogin', [AuthController::class, 'ProsesLogin']);
Route::get('/redirect', [RedirectController::class, 'cek']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/setting-account', [AuthController::class, 'settingAccount'])->name('setting-account');
Route::post('/postChangeProfile', [AuthController::class, 'postChangeProfile'])->name('postChangeProfile');

Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::post('editUser', [AuthController::class, 'editUser'])->name('editUser');
    Route::delete('voidUser/{id}', [AuthController::class, 'voidUser'])->name('voidUser');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index']);
    // your routes
});
// Route::get('/redirect', [RedirectController::class, 'cek']);
// });
// Route::get('/antrian', [HomeController::class, 'antrian']);

// RM SEARCH
Route::group(['middleware' => ['auth', 'checkrole:1,5']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('registrasi', [HomeController::class, 'registrasi']);
    Route::get('registrasiView', [HomeController::class, 'registrasiView'])->name('registrasiView');
    Route::get('data-sosial', [HomeController::class, 'dasos'])->name('data-sosial');
    Route::get('registrasiSearch', [HomeController::class, 'registrasiSearch'])->name('registrasiSearch');
    Route::get('getDasos/{fs_mr}', [HomeController::class, 'getDasos'])->name('getDasos');
    Route::get('getLayananMedis/{id_layanan}', [HomeController::class, 'getLayananMedis'])->name('getLayananMedis');
    Route::get('getAllDasos', [HomeController::class, 'getAllDasos'])->name('getAllDasos');
});


// REG + DASOS CREATE,EDIT DELETE
// Route::controller(registrasiController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,5']], function () {
    Route::post('create-registrasi', [registrasiController::class, 'registrasiCreate'])->name('create-registrasi');
    Route::post('edit-registrasi', [registrasiController::class, 'editRegister'])->name('edit-registrasi');
    Route::post('create-dasos', [registrasiController::class, 'store'])->name('create-dasos');
    Route::post('edit-dasos', [registrasiController::class, 'editDasos'])->name('edit-dasos');
    Route::get('delete-dasos', [registrasiController::class, 'deleteDasos'])->name('delete-dasos');
    Route::post('voidRegister/{regID}', [registrasiController::class, 'voidRegister'])->name('voidRegister');

    Route::get('aktifasi-berkas', [aktifasiRegisterController::class, 'aktifasiRegister'])->name('aktifasi-berkas');
    Route::post('create-aktifasi', [aktifasiRegisterController::class, 'aktifasiCreate'])->name('create-aktifasi');
    Route::post('deaktif', [aktifasiRegisterController::class, 'deaktif'])->name('deaktif');
});


// MSTR SATU GET
// Route::controller(mastersatuController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('mstr-layanan', [mastersatuController::class, 'layanan'])->name('layanan');
    Route::get('mstr-medis', [mastersatuController::class, 'medis'])->name('medis');
    Route::get('mstr-jaminan', [mastersatuController::class, 'jaminan'])->name('jaminan');
    Route::get('mstr-tindakan', [mastersatuController::class, 'tindakan'])->name('tindakan');
    Route::get('mstr-nilai-tindakan', [mastersatuController::class, 'nilaiTindakan'])->name('nilai-tindakan');
    Route::get('satuan-pemeriksaan-lab', [mastersatuController::class, 'satuanPemeriksaanLab'])->name('satuan-pemeriksaan-lab');
    Route::get('satuan-pemeriksaan-lab', [mastersatuController::class, 'satuanPemeriksaanLab'])->name('satuan-pemeriksaan-lab');
    Route::get('jenis-pemeriksaan-lab', [mastersatuController::class, 'jenisPemeriksaanLab'])->name('jenis-pemeriksaan-lab');
    Route::get('tarif-lab', [mastersatuController::class, 'tarifLaboratorium'])->name('tarif-lab');
    Route::get('getListJenisPemeriksaan', [mastersatuController::class, 'getListJenisPemeriksaan'])->name('getListJenisPemeriksaan');
    Route::get('getSelectedItem/{kd_jenis_pemeriksaan_lab}', [mastersatuController::class, 'getSelectedItem'])->name('getSelectedItem');
});


// MSTR SATU POST
// Route::controller(mastersatuController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::post('add-mstr-layanan', [mastersatuController::class, 'layananCreate'])->name('add-mstr-layanan');
    Route::post('add-mstr-medis', [mastersatuController::class, 'DokterCreate'])->name('add-mstr-medis');
    Route::post('add-mstr-jaminan', [mastersatuController::class, 'jaminanCreate'])->name('add-mstr-jaminan');
    Route::post('add-mstr-tindakan', [mastersatuController::class, 'tindakanCreate'])->name('add-mstr-tindakan');
    Route::post('add-mstr-nilai-tindakan', [mastersatuController::class, 'nilaiTindakanCreate'])->name('add-mstr-nilai-tindakan');
    Route::post('add-jenis-pemeriksaan', [mastersatuController::class, 'addJenisPemeriksaan'])->name('add-jenis-pemeriksaan');
    Route::post('add-satuan-pemeriksaan', [mastersatuController::class, 'addSatuanPemeriksaan'])->name('add-satuan-pemeriksaan');
    Route::post('add-tariflab', [mastersatuController::class, 'addTarifLab'])->name('add-tariflab');
});

// MSTR SATU GET DOKTER
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function () {
    Route::get('template-order-resep', [mastersatuController::class, 'templateResep'])->name('template-order-resep');
    Route::post('add-template-resep', [mastersatuController::class, 'addTemplateResep'])->name('add-template-resep');
    Route::get('getDetailTemplate/{kdto}', [mastersatuController::class, 'getDetailTemplate'])->name('getDetailTemplate');
    Route::post('edit-template', [mastersatuController::class, 'editTemplateResep'])->name('edit-template');
    Route::post('delete-template', [mastersatuController::class, 'deleteTemplateResep'])->name('delete-template');
});

// VIEW AFTER POST
// Route::controller(mastersatuController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('view-mstr-layanan', [mastersatuController::class, 'viewLayanan'])->name('view-mstr-layanan');
    Route::get('view-mstr-medis', [mastersatuController::class, 'medis'])->name('view-mstr-medis');
    Route::get('view-mstr-jaminan', [mastersatuController::class, 'jaminan'])->name('view-mstr-jaminan');
    Route::get('view-mstr-tindakan', [mastersatuController::class, 'tindakan'])->name('view-mstr-tindakan');
});


// Route::controller(TindakanController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,2,3']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('tindakan-medis', [TindakanController::class, 'tindakanMedis'])->name('tindakan-medis');
    Route::get('SearchRegister/{kdReg}', [TindakanController::class, 'registerSearch'])->name('SearchRegister');
    Route::get('getTimeline/{mr}', [TindakanController::class, 'getTimeline'])->name('getTimeline');
    Route::get('getLabel/{mr}', [TindakanController::class, 'getLabel'])->name('getLabel');
    Route::get('chartIdSearch/{chartid}', [TindakanController::class, 'chartIdSearch'])->name('chartIdSearch');
    Route::get('getTimelineTdk/{mr}', [TindakanController::class, 'getTimelineTdk'])->name('getTimelineTdk');
    Route::get('getLastID', [TindakanController::class, 'getLastID'])->name('getLastID');
    Route::post('chartCreate', [TindakanController::class, 'chartCreate'])->name('chartCreate');
    Route::get('obatSearchCH', [TindakanController::class, 'obatSearchCH'])->name('obatSearchCH');
    Route::get('getObatListCH/{obat}', [TindakanController::class, 'getObatListCH'])->name('getObatListCH');
    Route::get('getIcdX', [TindakanController::class, 'getIcdX'])->name('getIcdX');
    Route::post('chartUpdate', [TindakanController::class, 'chartUpdate'])->name('chartUpdate');
    Route::post('chartDelete/{chartid}', [TindakanController::class, 'chartDelete'])->name('chartDelete');
    Route::get('getTemplateOrder', [TindakanController::class, 'getTemplateOrder'])->name('getTemplateOrder');
    Route::get('selectTemplateOrder', [TindakanController::class, 'selectTemplateOrder'])->name('selectTemplateOrder');

    Route::get('arsip', [arsipController::class, 'arsip'])->name('arsip');
    Route::get('regSearchArs', [arsipController::class, 'regSearchArs'])->name('regSearchArs');
    Route::get('getListChart/{fs_mr}', [arsipController::class, 'getListChart'])->name('getListChart');
    Route::get('getListChartDetail/{chart_id}', [arsipController::class, 'getListChartDetail'])->name('getListChartDetail');

    Route::get('getRegAktifasi', [aktifasiRegisterController::class, 'getRegAktifasi'])->name('getRegAktifasi');
    Route::get('selectRegAktifasi/{fr_mr}', [aktifasiRegisterController::class, 'selectRegAktifasi'])->name('selectRegAktifasi');
});


// VIEW MSTR FARMASI
// Route::controller(masterFarmasiController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,4']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('mstr-kategori-produk', [masterFarmasiController::class, 'katProd'])->name('mstr-kategori-produk');
    Route::get('mstr-golongan-obat', [masterFarmasiController::class, 'golonganObat'])->name('mstr-golongan-obat');
    Route::get('mstr-satuan', [masterFarmasiController::class, 'satuan'])->name('mstr-satuan');
    Route::get('mstr-lokasi-stock', [masterFarmasiController::class, 'lokStock'])->name('mstr-lokasi-stock');
    Route::get('mstr-jenis-obat', [masterFarmasiController::class, 'jenBat'])->name('mstr-jenis-obat');
    Route::get('mstr-supplier', [masterFarmasiController::class, 'supplier'])->name('mstr-supplier');
    Route::get('mstr-obat', [masterFarmasiController::class, 'obat'])->name('mstr-Obat');
    Route::get('getMsaterObat', [masterFarmasiController::class, 'getMsaterObat'])->name('getMsaterObat');
});

// CREATE MSTR FARMASI
// Route::controller(masterFarmasiController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,4']], function () {
    Route::post('add-mstr-kategori-produk', [masterFarmasiController::class, 'katProdCreate'])->name('add-mstr-kategori-produk');
    Route::post('edit-mstr-kategori', [masterFarmasiController::class, 'editKategori'])->name('edit-mstr-kategori');
    Route::post('add-mstr-satuan', [masterFarmasiController::class, 'satuanCreate'])->name('add-mstr-satuan');
    Route::post('edit-mstr-satuan', [masterFarmasiController::class, 'editSatuan'])->name('edit-mstr-satuan');
    Route::post('add-mstr-lokasi-stock', [masterFarmasiController::class, 'lokstockCreate'])->name('add-mstr-lokasi-stock');
    Route::post('add-mstr-jenis-obat', [masterFarmasiController::class, 'jenBatCreate'])->name('add-mstr-jenis-obat');
    Route::post('edit-jenis-obat', [masterFarmasiController::class, 'jenBatEdit'])->name('edit-jenis-obat');
    Route::post('add-mstr-supplier', [masterFarmasiController::class, 'supplierCreate'])->name('add-mstr-supplier');
    Route::post('add-mstr-obat', [masterFarmasiController::class, 'obatCreate'])->name('add-mstr-obat');
    Route::post('edit-mstr-obat/{efmkdobat}', [masterFarmasiController::class, 'obatEdit'])->name('edit-mstr-obat');
    Route::post('deleteObat/{kd_obat}', [masterFarmasiController::class, 'obatDelete'])->name('deleteObat');
});

// DELETE MSTR FARMASI
// Route::controller(masterFarmasiController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,4']], function () {
    Route::delete('destroy-mstr-kategori-produk/{id}', [masterFarmasiController::class, 'katProdCreate'])->name('destroy-mstr-kategori-produk');
    Route::delete('destroy-mstr-satuan/{id}', [masterFarmasiController::class, 'satuanDestroy'])->name('destroy-mstr-satuan');
    Route::delete('destroy-mstr-lokasi-stock/{id}', [masterFarmasiController::class, 'lokStockDestroy'])->name('destroy-mstr-lokasi-stock');
    Route::delete('destroy-mstr-jenis-obat/{id}', [masterFarmasiController::class, 'jenBatDestroy'])->name('destroy-mstr-jenis-obat');
    Route::delete('destroy-mstr-supplier/{id}', [masterFarmasiController::class, 'supplier'])->name('destroy-mstr-supplier');
    Route::delete('destroy-mstr-obat/{id}', [masterFarmasiController::class, 'obat'])->name('destroy-mstr-Obat');
    // Route::post('/create-dasos', [registrasiController::class, 'store']);
});

// VIEW PO-DO
// Route::controller(poDoController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,4']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('purchase-order', [poDoController::class, 'po'])->name('purchase-order');
    Route::get('delivery-order', [poDoController::class, 'do'])->name('delivery-order');
    Route::get('adjusment-stock', [poDoController::class, 'adj'])->name('adjusment-stock');
    Route::get('obatSearch', [poDoController::class, 'obatSearch'])->name('obatSearch');
    Route::get('getObatList/{obat}', [poDoController::class, 'getObatList'])->name('getObatList');
    Route::get('get-data-do/{kd_do}', [poDoController::class, 'getDOList'])->name('get-data-do');
    Route::get('getListObatDO', [poDoController::class, 'getListObatDO'])->name('getListObatDO');
    Route::get('getMonthAdjusment', [poDoController::class, 'getMonthAdjusment'])->name('getMonthAdjusment');
    Route::get('getDetailAdjusment/{kd_trs}', [poDoController::class, 'getDetailAdjusment'])->name('getDetailAdjusment');
    Route::get('getMonthPO', [poDoController::class, 'getMonthPO'])->name('getMonthPO');
    Route::get('getDetailPO/{po_hdr_kd}', [poDoController::class, 'getDetailPO'])->name('getDetailPO');
    Route::get('getListPoActive', [poDoController::class, 'getListPoActive'])->name('getListPoActive');
});


// CREATE PO-DO + ADJ
// Route::controller(poDoController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,4']], function () {
    Route::post('add-delivery-order', [poDoController::class, 'doCreate'])->name('add-delivery-order');
    Route::post('add-purchase-order', [poDoController::class, 'poCreate'])->name('add-purchase-order');
    Route::post('CreateAdj', [poDoController::class, 'createAdj'])->name('CreateAdj');
});

// PENJUALAN FARMASI
// Route::controller(penjualanController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,4']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('penjualan', [penjualanController::class, 'penjualan'])->name('penjualan');
    Route::get('getListObatReguler', [penjualanController::class, 'getListObatReguler'])->name('getListObatReguler');
    Route::get('getListObatResep', [penjualanController::class, 'getListObatResep'])->name('getListObatResep');
    Route::get('getListObatNakes', [penjualanController::class, 'getListObatNakes'])->name('getListObatNakes');
    Route::get('getListObatRegulerEdit', [penjualanController::class, 'getListObatRegulerEdit'])->name('getListObatRegulerEdit');
    Route::get('getListObatResepEdit', [penjualanController::class, 'getListObatResepEdit'])->name('getListObatResepEdit');
    Route::get('getListObatNakesEdit', [penjualanController::class, 'getListObatNakesEdit'])->name('getListObatNakesEdit');
    Route::post('add-penjualan', [penjualanController::class, 'penjualanCreate'])->name('add-penjualan');
    Route::post('update-penjualan', [penjualanController::class, 'updateTrsPenjualan'])->name('update-penjualan');
    Route::get('update-penjualanG', [penjualanController::class, 'updateTrsPenjualan'])->name('update-penjualanG');
    Route::get('getListOrderResep/{kd_trs}', [penjualanController::class, 'getListOrderResep'])->name('getListOrderResep');
    Route::get('getDetailPenjualan/{kd_trs}', [penjualanController::class, 'getDetailPenjualan'])->name('getDetailPenjualan');
    Route::get('nota', [penjualanController::class, 'cetakNota'])->name('nota');
    Route::get('getMonthSales', [penjualanController::class, 'getMonthSales'])->name('getMonthSales');
    Route::post('delete-trs-penjualan', [penjualanController::class, 'DelTrsPenjualan'])->name('delete-trs-penjualan');
});

// VIEW TRS-KASIR-POLI
// Route::controller(kasirPoliController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,4,3']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('kasir-poli', [kasirPoliController::class, 'kasirPoli'])->name('kasir-poli');
    Route::get('SearchRegisterKsr/{kdReg}', [kasirPoliController::class, 'xregisterSearch'])->name('SearchRegisterKsr');
    Route::get('getMonthRegOut', [kasirPoliController::class, 'getMonthRegOut'])->name('getMonthRegOut');
    Route::get('getDetailRegOut/{kd_trs}', [kasirPoliController::class, 'getDetailRegOut'])->name('getDetailRegOut');

    Route::get('kasir-apotek', [kasirPoliController::class, 'kasirApotek'])->name('kasir-apotek');
    Route::post('regout', [kasirPoliController::class, 'regOut'])->name('regout');
    Route::post('EditRegout', [kasirPoliController::class, 'EditRegout'])->name('EditRegout');
});


//Wilayah
Route::controller(WilayahController::class)->group(function () {
    Route::get('provinces', 'provinces')->name('provinces');
    Route::get('cities', 'cities')->name('cities');
    Route::get('districts', 'districts')->name('districts');
    Route::get('villages', 'villages')->name('villages');
});

//Assesment Awal
// Route::controller(AssesmentController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,2,3']], function () {
    Route::get('assesment-awal', [AssesmentController::class, 'assAwal'])->name('assesment-awal');
    Route::post('addAssesment', [AssesmentController::class, 'createAssesment'])->name('addAssesment');
    Route::get('getLabelAssHdr/{noMr}', [AssesmentController::class, 'getLabelAssHdr'])->name('getLabelAssHdr');
    Route::get('getAssDetail/{assId}', [AssesmentController::class, 'getAssDetail'])->name('getAssDetail');
});

//Laporan Farmasi
// Route::controller(LapFarmasiController::class)->group(function () {
Route::group(['middleware' => ['auth', 'checkrole:1,4']], function () {
    // Route::get('/', [HomeController::class, 'index']);
    // Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('laporan-penjualan-farmasi-rekap', [LapFarmasiController::class, 'lapPenjualanFarmasiRekap'])->name('laporan-penjualan-farmasi-rekap');
    Route::get('laporan-penjualan-farmasi-detail', [LapFarmasiController::class, 'lapPenjualanFarmasiDetail'])->name('laporan-penjualan-farmasi-detail');
    Route::get('getLaporanPenjualanRekap', [LapFarmasiController::class, 'getLapPenjualanRekap'])->name('getLaporanPenjualanRekap');
    Route::get('getLaporanPenjualanDetail', [LapFarmasiController::class, 'getLapPenjualanDetail'])->name('getLaporanPenjualanDetail');
    Route::get('buku-stok-rekap', [LapFarmasiController::class, 'bukuStok'])->name('buku-stok-rekap');
    Route::get('getBukuStok', [LapFarmasiController::class, 'getBukuStok'])->name('getBukuStok');
    Route::get('kartu-stok', [LapFarmasiController::class, 'karatuStok'])->name('kartu-stok');
    Route::get('getKartuStok', [LapFarmasiController::class, 'getKartuStok'])->name('getKartuStok');
    Route::get('laporan-registrasi-masuk', [LapFarmasiController::class, 'lapRegMasuk'])->name('laporan-registrasi-masuk');
    Route::get('getLapRegMasuk', [LapFarmasiController::class, 'getLapRegMasuk'])->name('getLapRegMasuk');
    Route::get('pendapatan-klinik-rekap', [LapFarmasiController::class, 'lapKlinikRekap'])->name('pendapatan-klinik-rekap');
    Route::get('getLapPendapatanKlinik', [LapFarmasiController::class, 'getLapPendapatanKlinik'])->name('getLapPendapatanKlinik');
    Route::get('pembelian-detail', [LapFarmasiController::class, 'pembelianDetail'])->name('pembelian-detail');
    Route::get('getPembelianDetail', [LapFarmasiController::class, 'getPembelianDetail'])->name('getPembelianDetail');
    Route::get('info-tindakan', [LapFarmasiController::class, 'infoTindakan'])->name('info-tindakan');
    Route::get('getInfoTindakan', [LapFarmasiController::class, 'getinfoTindakan'])->name('getInfoTindakan');
    Route::get('itemObatSearch', [LapFarmasiController::class, 'itemObatSearch'])->name('itemObatSearch');
    Route::get('pricelist', [LapFarmasiController::class, 'pricelist'])->name('pricelist');
    Route::get('pricelistHrgReguler', [LapFarmasiController::class, 'pricelistHrgReguler'])->name('pricelistHrgReguler');
    Route::get('pricelistHrgResep', [LapFarmasiController::class, 'pricelistHrgResep'])->name('pricelistHrgResep');
    Route::get('pricelistHrgNakes', [LapFarmasiController::class, 'pricelistHrgNakes'])->name('pricelistHrgNakes');
    Route::get('laporan-tuslah-embalase', [LapFarmasiController::class, 'lapTuslahEmbalase'])->name('laporan-tuslah-embalase');
    Route::get('getLaporanTuslahEmbalase', [LapFarmasiController::class, 'getLaporanTuslahEmbalase'])->name('getLaporanTuslahEmbalase');
    Route::get('laporan-kondisi-stok', [LapFarmasiController::class, 'lapKondisiStok'])->name('laporan-kondisi-stok');
    Route::get('getLapKondisiStok', [LapFarmasiController::class, 'getLapKondisiStok'])->name('getLapKondisiStok');
});

//Laporan Analisa
Route::group(['middleware' => ['auth', 'checkrole:1,4']], function () {
    Route::get('produk-terlaris', [analisaController::class, 'laporanProdukTerlaris'])->name('produk-terlaris');
    Route::get('getLaporanProdukTerlaris', [analisaController::class, 'getLaporanProdukTerlaris'])->name('getLaporanProdukTerlaris');
});

//Accounting / KEU
Route::group(['middleware' => ['auth', 'checkrole:1,4,6']], function () {
    Route::get('pelunasan-hutang', [HutangSupplierController::class, 'pelunasanHutang'])->name('pelunasan-hutang');
    Route::get('list-hutang', [HutangSupplierController::class, 'getListHutang'])->name('list-hutang');
    Route::post('add-pelunasan-hutang', [HutangSupplierController::class, 'pelunasanCreate'])->name('add-pelunasan-hutang');
    Route::get('getMonthPelunasan', [HutangSupplierController::class, 'getMonthPelunasan'])->name('getMonthPelunasan');
    Route::get('info-hutang', [HutangSupplierController::class, 'infoHutang'])->name('info-hutang');
    Route::get('getinfohutang', [HutangSupplierController::class, 'getInfoHutang'])->name('getinfohutang');

    Route::get('laporan-laba', [lapAccountingController::class, 'laporanLaba'])->name('laporanLaba');
    Route::get('getLaporanLR', [lapAccountingController::class, 'laporanLR'])->name('getLaporanLR');
    Route::get('laba-rugi-peritem', [lapAccountingController::class, 'labaRugiPerItem'])->name('laba-rugi-peritem');
    Route::get('getLabaRugiPerItem', [lapAccountingController::class, 'getLabaRugiPerItem'])->name('getLabaRugiPerItem');
});

//Setting / Tools
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function () {
    Route::get('hak-akses', [settingController::class, 'hakAkses'])->name('hak-akses');
    Route::post('userCreate', [settingController::class, 'userCreate'])->name('userCreate');
    Route::get('profile-perusahaan', [settingController::class, 'profilePerusahaan'])->name('profile-perusahaan');
    Route::post('createProfile', [settingController::class, 'createProfile'])->name('createProfile');
});

//Universal Look Up
Route::group(['middleware' => ['auth', 'checkrole:1,2,3,4,5']], function () {
    Route::get('getuniversalLookUp', [lookUpController::class, 'getuniversalLookUp'])->name('getuniversalLookUp');
});

//Transaksi Laboratorium
Route::group(['middleware' => ['auth', 'checkrole:1,2,3,4,5']], function () {
    Route::get('pemeriksaan-lab', [trsLabController::class, 'pemeriksaanLab'])->name('pemeriksaanLab');
    Route::get('getListOrderLab/{kd_trs}', [trsLabController::class, 'getListOrderLab'])->name('getListOrderLab');

    Route::post('insert-trslab', [trsLabController::class, 'inserttrsLab'])->name('insert-trslab');
});

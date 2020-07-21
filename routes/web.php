<?php

// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |

// Method Get() biasa digunakan untuk melakukan  pemanggilan url
//  / -> ialah index seperti 'domain.com/index.php'
Route::get('/', 'Auth\LoginController@showLoginForm');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
->namespace('Admin')
        ->middleware(['auth', 'admin'])
        ->group(function () {
            Route::get('/', 'DashBoardAdminController@admin')->name('dashboard');

            Route::resource('pemasok', 'SupplierController');

            Route::get('barang-masuk/cari-barang', 'SupplierController@cari_barang_masuk');

            Route::get('jenis_barang/cari-jb', 'JenisItemController@cari_jb');

            Route::resource('jenis_barang', 'JenisItemController');

            Route::get('detail_barang/cari-master-barang', 'ItemController@cari_barang');

            Route::resource('detail_barang', 'ItemController');

            // Route::get('transaksi', 'TransaksiController@create');

            Route::get('/jenis-barang-select/{id}', 'JenisItemController@codeAjax');

            Route::get('/barang-select/{id}', 'ItemController@codeAjax');

            Route::get('/supplier-select/{id}', 'SupplierController@codeAjax');

            Route::get('transaksi-select/{id}', 'TransaksiController@codeAjax');

            // Route::get('searchajax', array('as' => 'searchajax', 'uses' => 'TransaksiController@loadData'));

            Route::get('cari', 'GudangController@loadData');

            Route::get('/cari-supplier', 'SupplierController@loadData');

            Route::get('/cari-barang', 'ItemController@loadData');

            Route::get('/cari-jenis-barang', 'JenisItemController@loadData');

            Route::get('transaksi/cetak', 'TransaksiTempController@cetak');

            Route::resource('transaksi', 'TransaksiTempController');

            Route::get('transaksi-delete/{id}', 'TransaksiTempController@destroy');

            Route::get('transaksi-update/{id}/update', 'TransaksiTempController@edit');

            Route::patch('transaksi-update/{id}', 'TransaksiTempController@update');

            Route::get('gudang/cari-gudang', 'GudangController@cari_gudang');

            Route::resource('gudang', 'GudangController');

            Route::get('info-pemasok/cari-pemasok', 'SupplierUserController@cari_supplier');

            Route::resource('info-pemasok', 'SupplierUserController');

            Route::get('laporan-stok-barang', 'LaporanBarangMasukController@index');

            Route::get('laporan-stok-barang/detail/{id}', 'LaporanBarangMasukController@show');

            Route::get('laporan-stok', 'LaporanStokController@index');
            // Automatic search and sort
            Route::get('laporan-stok/cari-laporan', 'LaporanStokController@fetch_data');

            Route::get('laporan-stok-out/cari-transaksi', 'LaporanStokController@cari_stok_out');

            Route::get('laporan-stok-out', 'LaporanStokController@stockout');

            Route::get('laporan-stok-out/{id}', 'LaporanStokController@stockout_detail');

            Route::get('detail-return-barang/cari-return', 'ReturnBarangDetailController@cari_return');

            Route::get('form-return-barang/return-barang/{code_transaksi}/{code_item}/{tgl}/{code_return}', 'ReturnBarangController@return');

            Route::get('form-return-barang', 'ReturnBarangController@index');

            Route::post('form-return-barang', 'ReturnBarangController@store');

            Route::get('form-return-barang/cari', 'ReturnBarangController@search');

            Route::patch('detail-return-barang/{id}', 'ReturnBarangDetailController@update');

            Route::delete('detail-return-barang/{id}', 'ReturnBarangDetailController@destroy');

            Route::get('detail-return-barang', 'ReturnBarangDetailController@index');

            Route::get('detail-return/{id}', 'ReturnBarangDetailController@show');

            Route::get('detail-return-barang/{id}/edit', 'ReturnBarangDetailController@edit');

            Route::get('tambah-aktifitas', 'AktifitasDetailController@create');

            Route::post('tambah-aktifitas', 'AktifitasDetailController@store');

            Route::get('form-aktifitas-delete/{id}/{code}', 'AktifitasDetailController@destroy');

            Route::get('form-aktifitas-update/{id}/update/{code}', 'AktifitasDetailController@edit');

            Route::patch('form-aktifitas-update/{id}/{aktifitas}', 'AktifitasDetailController@update');

            Route::get('laporan-aktifitas', 'AktivitasController@index');

            Route::get('laporan-aktifitas/{id}/detail', 'AktifitasDetailController@show');
        });

Route::prefix('kasir')
        ->namespace('Kasir')
        ->middleware(['auth', 'cashier'])
        ->group(function () {
            Route::get('/', 'DashBoardAdminController@kasir');

            Route::get('transaksi-select/{id}', 'TransaksiController@codeAjax');

            Route::get('cari', 'GudangController@loadData');

            Route::get('transaksi/cetak', 'TransaksiTempController@cetak');

            Route::resource('transaksi', 'TransaksiTempController');

            Route::get('transaksi-delete/{id}', 'TransaksiTempController@destroy');

            Route::get('transaksi-update/{id}/update', 'TransaksiTempController@edit');

            Route::patch('transaksi-update/{id}', 'TransaksiTempController@update');

            Route::get('gudang/cari-gudang', 'GudangController@cari_gudang');

            Route::resource('gudang', 'GudangController');

            Route::get('detail-return-barang/cari-return', 'ReturnBarangDetailController@cari_return');

            Route::get('form-return-barang/return-barang/{code_transaksi}/{code_item}/{tgl}/{code_return}', 'ReturnBarangController@return');

            Route::get('form-return-barang', 'ReturnBarangController@index');

            Route::post('form-return-barang', 'ReturnBarangController@store');

            Route::get('form-return-barang/cari', 'ReturnBarangController@search');

            Route::patch('detail-return-barang/{id}', 'ReturnBarangDetailController@update');

            Route::delete('detail-return-barang/{id}', 'ReturnBarangDetailController@destroy');

            Route::get('detail-return-barang', 'ReturnBarangDetailController@index');

            Route::get('detail-return/{id}', 'ReturnBarangDetailController@show');

            Route::get('detail-return-barang/{id}/edit', 'ReturnBarangDetailController@edit');

            Route::get('tambah-aktifitas', 'AktifitasDetailController@create');

            Route::post('tambah-aktifitas', 'AktifitasDetailController@store');

            Route::get('form-aktifitas-delete/{id}/{code}', 'AktifitasDetailController@destroy');

            Route::get('form-aktifitas-update/{id}/update/{code}', 'AktifitasDetailController@edit');

            Route::patch('form-aktifitas-update/{id}/{aktifitas}', 'AktifitasDetailController@update');

            Route::get('laporan-aktifitas', 'AktivitasController@index');

            Route::get('laporan-aktifitas/{id}/detail', 'AktifitasDetailController@show');
        });

Auth::routes();

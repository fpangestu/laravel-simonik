<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('awal');

Auth::routes();

 Route::get('/home', 'HomeController@index')->name('home2');

//Kegiatan Penelitian
Route::get('/kegiatan_penelitian', 'KegiatanPenelitianController@index')->name('home');
Route::get('/kegiatan_penelitian_baru', 'KegiatanPenelitianBaruController@index');
Route::post('/kegiatan_penelitian_baru/simpan', 'KegiatanPenelitianBaruController@tambah');
Route::get('/kegiatan_penelitian_rincian', 'KegiatanPenelitianRincianController@index');

//Pengaturan Pegawai
Route::get('/pengaturan/pegawai', 'PengaturanPegawaiController@index');
Route::post('/pengaturan/pegawai/tambah', 'PengaturanPegawaiController@tambah');
Route::post('/pengaturan/pegawai/edit', 'PengaturanPegawaiController@editdata');
Route::post('/pengaturan/pegawai/edit/restore', 'PengaturanPegawaiController@restore');
//Pengaturan Dokumen
Route::get('/pengaturan/dokumen', 'PengaturanDokumenController@index');
Route::post('/pengaturan/dokumen/tambah', 'PengaturanDokumenController@tambah');
Route::post('/pengaturan/dokumen/edit', 'PengaturanDokumenController@editdata');
Route::post('/pengaturan/dokumen/edit/restore', 'PengaturanDokumenController@restore');
//Pengaturan Kegiatan
Route::get('/pengaturan/kegiatan', 'PengaturanAgendaKegiatanController@index');
Route::post('/pengaturan/kegiatan/tambah', 'PengaturanAgendaKegiatanController@tambah');
Route::post('/pengaturan/kegiatan/edit', 'PengaturanAgendaKegiatanController@editdata');
Route::post('/pengaturan/kegiatan/edit/restore', 'PengaturanAgendaKegiatanController@restore');


Route::get('/pengaturan/narasumber', 'PengaturanNarasumberController@index');
Route::get('/pengaturan/dokumen', 'PengaturanDokumenController@index');


<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('guest')->name('home');
Route::get('/login', 'AuthController@login')->middleware('guest')->name('login');
Route::post('/doLogin', 'AuthController@doLogin')->name('doLogin');
Route::get('/register', 'AuthController@register')->middleware('guest')->name('register');
Route::post('/doRegister', 'AuthController@doRegister')->name('doRegister');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'wadir3']],function(){
    Route::get('/dashboard-wadir3', 'Wadir3Controller@index')->name('wadir3.index');
    // Route::resource('/wadir3-mahasiswa', 'MahasiswaController');
    Route::resource('/wadir3-beasiswa', 'BeasiswaController');
    Route::get('/wadir3/laporan-beasiswa', 'Wadir3Controller@laporan')->name('wadir3.laporan');
    
    Route::get('/wadir3/laporan', 'Wadir3Controller@filter_laporan')->name('wadir3.filterLaporan');
});
Route::group(['middleware' => ['auth', 'akademik']],function(){
    Route::get('/akademik', 'AkademikController@index')->name('akademik.index');
    // Route::resource('/akademik-mahasiswa', 'MahasiswaController');
    Route::resource('/akademik-beasiswa', 'BeasiswaController');
    Route::get('/akademik/calon_penerima_beasiswa', 'AkademikController@calon_penerima_beasiswa')->name('akademik.calon_penerima_beasiswa');
    Route::get('/akademik/calon_penerima_beasiswa/{id_pendaftaran}/detail', 'AkademikController@calon_penerima_beasiswa_detail')->name('akademik.calon_penerima_beasiswa-detail');
    Route::post('/akademik/calon_penerima_beasiswa/{id_pendaftaran}/edit', 'AkademikController@calon_penerima_beasiswa_edit')->name('akademik.calon_penerima_beasiswa-edit');
    Route::get('/akademik/laporan-beasiswa', 'AkademikController@laporan')->name('akademik.laporan');
    
    Route::get('/akademik/laporan', 'AkademikController@filter_laporan')->name('akademik.filterLaporan');
});

Route::group(['middleware' => ['auth', 'adminprodi']],function(){
    Route::get('/admin-prodi', 'AdminprodiController@index')->name('admin-prodi.index');
    Route::resource('/admin/mahasiswa', 'MahasiswaController');
    Route::resource('/admin/beasiswa', 'BeasiswaController');
    Route::get('/admin/pengumuman', 'AdminprodiController@pengumuman')->name('admin-prodi.pengumuman');
    Route::get('/admin/pengumuman/{id_pendaftaran}/detail', 'AdminprodiController@pengumuman_detail')->name('admin-prodi.pengumuman-detail');
    Route::post('/admin/pengumuman/{id_pendaftaran}/edit', 'AdminprodiController@pengumuman_edit')->name('admin-prodi.pengumuman-edit');
    
});

Route::group(['middleware' => ['auth', 'mahasiswa']],function(){
    Route::get('/dashboard-mahasiswa', 'MahasiswaController@dashboard')->name('mahasiswa.dashboard');
    Route::get('/profile-mahasiswa/{id}', 'MahasiswaController@profile')->name('mahasiswa.profile');
    Route::post('/update-profile-mahasiswa/{id}', 'MahasiswaController@update')->name('mahasiswa.update-profile');
    Route::get('/pendaftaran_beasiswa/{id}', 'MahasiswaController@pendaftaran_beasiswa')->name('mahasiswa.pendaftaran-beasiswa');
    Route::post('/pendaftaran_beasiswa/{id}/daftar', 'MahasiswaController@do_pendaftaran_beasiswa')->name('mahasiswa.do-pendaftaran-beasiswa');
    // Route::resource('/beasiswa-mahasiswa', 'BeasiswaController');
    Route::resource('/datakeluarga-mahasiswa', 'DataKeluargaController');
    Route::resource('/datarumah-mahasiswa', 'DataRumahController');
    Route::get('/pengumuman-mahasiswa/{id}', 'MahasiswaController@pengumuman')->name('mahasiswa.pengumuman');
    
});
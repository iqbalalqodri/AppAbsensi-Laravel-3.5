<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('Master', function () {
    return view('LayoutAdmin.MasterMain');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/absen', 'HomeController@absen');

Route::get('/Login-Admin', 'LoginAdmin@index');
Route::post('/Login-Admin', 'LoginAdmin@PostLogin');
Route::get('/Logoutt','LoginAdmin@Logout' );
Route::get('/homeAdmin', 'Admin@index');
Route::get('/Absensi', 'Admin@indexAbsensi');
Route::get('/Absensi-{id}', 'Admin@DetailAbsensi');

Route::get('/Data-Pegawai', 'Admin@indexDataPegawai');
Route::get('/AddData-Pegawai', 'Admin@indexAddDataPegawai');
Route::post('/AddData-Pegawai', 'Admin@PostAddDataPegawai');
Route::get('/EditData-Pegawai-{id}', 'Admin@indexEditDataPegawai');
Route::post('/EditData-Pegawai-{id}', 'Admin@PostEditDataPegawai');
Route::post('/DeleteData-Pegawai-{id}', 'Admin@PostDeleteDataPegawai');

Route::get('/Data-Jabatan', 'Admin@indexDataJabatan');
Route::get('/AddData-Jabatan', 'Admin@indexAddDataJabatan');
Route::post('/AddData-Jabatan', 'Admin@PostAddDataJabatan');
Route::get('/EditData-Jabatan-{id}', 'Admin@indexEditDataJabatan');
Route::post('/EditData-Jabatan-{id}', 'Admin@PostEditDataJabatan');
Route::post('/DeleteData-Jabatan-{id}', 'Admin@PostDeleteDataJabatan');


Route::get('/Setting-Akun', 'Admin@indexSettingAkun');
Route::post('/Setting-Akun', 'Admin@PostSettingAkun');


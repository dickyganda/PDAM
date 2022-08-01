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
    return view('/autentikasi/login');
});

// Auth::routes();

Route::get('/autentikasi/login', 'AuthController@login');
Route::post('/dashboard/login', 'AuthController@postlogin2');
Route::get('autentikasi/ubahpassord/{id_user}','AuthController@ubahpassword');
Route::post('autentikasi/updatepassword','AuthController@updatepassword');
Route::get('/logout', 'AuthController@logout2');
// Route::get('/autentikasi/login', 'AuthController@logout');

Route::get('dashboard/index', 'DashboardController@index')->name('dashboard');

Route::get('datamasterpelanggan/index', 'DatamasterpelangganController@index');
Route::post('datamasterpelanggan/tambahpelanggan','DatamasterpelangganController@tambahpelanggan');
Route::get('datamasterpelanggan/editpelanggan/{id_pelanggan}','DatamasterpelangganController@editpelanggan');
Route::post('datamasterpelanggan/updatepelanggan','DatamasterpelangganController@updatepelanggan');
Route::get('datamasterpelanggan/deletepelanggan/{id_pelanggan}','DatamasterpelangganController@deletepelanggan');
Route::post('hitungtotalsaldo/{id_pelanggan}','DatatransaksiController@hitungsaldo');

Route::get('datamasterharga/index', 'DatamasterhargaController@index');
Route::post('datamasterharga/tambahharga','DatamasterhargaController@tambahharga');
Route::get('datamasterharga/editharga/{id_harga}','DatamasterhargaController@editharga');
Route::post('datamasterharga/updateharga','DatamasterhargaController@updateharga');
Route::get('datamasterharga/deleteharga/{id_harga}','DatamasterhargaController@deleteharga');

Route::get('datamasterclass/index', 'DatamasterclassController@index');
Route::post('datamasterclass/tambahclass','DatamasterclassController@tambahclass');
Route::get('datamasterclass/editclass/{id_class}','DatamasterclassController@editclass');
Route::post('datamasterclass/updateclass','DatamasterclassController@updateclass');

Route::get('datamasteruser/index', 'DatamasteruserController@index');
Route::post('datamasteruser/tambahuser','DatamasteruserController@tambahuser');

Route::get('datamasteruserlevel/index', 'DatamasteruserlevelController@index');

Route::get('datatransaksi/index', 'DatatransaksiController@index');
Route::get('datatransaksi/edittransaksi/{id}','DatatransaksiController@edittransaksi');
Route::post('datatransaksi/updatetransaksi','DatatransaksiController@updatetransaksi');
Route::post('hitungsaldo/{id}','DatatransaksiController@hitungsaldo');
Route::post('updatetunggakan/{id}','DatatransaksiController@updatetunggakan');
Route::get('datatransaksi/report/{id}', 'DatatransaksiController@viewreport');
Route::get('datatransaksi/reportthermal/{id}', 'DatatransaksiController@viewreportthermal');
// Route::get('image/{filename}', [DatatransaksiController::class,'getPubliclyStorgeFile'])->name('image.displayImage');

Route::get('report/index', 'ReportController@index');
Route::post('report/filter_rt','ReportController@filter_rt');
Route::get('report/print_preview', 'ReportController@printpreview');

Route::get('/token', function () {
    return csrf_token();
});



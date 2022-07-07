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
    return view('/dashboard/index');
});

// Auth::routes();

Route::get('/login', 'AuthController@login');
Route::post('/dashboard/login', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::get('dashboard/index', 'DashboardController@index');

Route::get('datamasterpelanggan/index', 'DatamasterpelangganController@index');
Route::post('datamasterpelanggan/tambahpelanggan','DatamasterpelangganController@tambahpelanggan');
Route::post('datamasterpelanggan/updatepelanggan','DatamasterPelangganController@updatepelanggan');

Route::get('datamasterharga/index', 'DatamasterhargaController@index');
Route::post('datamasterharga/tambahharga','DatamasterhargaController@tambahharga');

Route::get('datamasterclass/index', 'DatamasterclassController@index');
Route::post('datamasterclass/tambahclass','DatamasterclassController@tambahclass');

Route::get('datamasteruser/index', 'DatamasteruserController@index');
Route::post('datamasteruser/tambahuser','DatamasteruserController@tambahuser');

Route::get('datamasteruserlevel/index', 'DatamasteruserlevelController@index');

Route::get('datatransaksi/index', 'DatatransaksiController@index');
Route::get('datatransaksi/report', 'DatatransaksiController@viewreport');
Route::get('datatransaksi/reportthermal', 'DatatransaksiController@viewreportthermal');

Route::get('/token', function () {
    return csrf_token();
});



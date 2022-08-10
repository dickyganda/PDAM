<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('transaksi/getdatapelanggan/{kode_pelanggan}', 'ApiController@Getdatapelanggan');

Route::post('transaksi/tambahtransaksimeter', 'ApiController@insertmeter');

Route::post('/dashboard/login', 'ApiController@postlogin2');



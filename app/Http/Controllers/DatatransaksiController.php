<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Model\T_Meter;

class DatatransaksiController extends Controller
{
    
function Index(){

    $datatransaksi = DB::table('t_meter')
    ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
    ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
    ->join('m_harga', 'm_harga.id_harga', '=', 't_meter.id_harga')
    ->get();

    $saldo = "SELECT tagihan, biaya_admin, biaya_perawatan, tunggakan, 
    tagihan + biaya_admin + biaya_perawatan + tunggakan as saldo from t_meter";
    // dd($saldo);

    	return view('/datatransaksi/index', ['datatransaksi' => $datatransaksi]);
    }

}
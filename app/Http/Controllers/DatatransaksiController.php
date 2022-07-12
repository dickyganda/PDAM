<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Meter;

class DatatransaksiController extends Controller
{
    
function Index(){

    $datatransaksi = DB::table('t_meter')
    ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
    ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
    ->join('m_harga', 'm_harga.id_harga', '=', 't_meter.id_harga')
    ->get();

    	return view('/datatransaksi/index', ['datatransaksi' => $datatransaksi]);
    }

function viewreport($id){

        $datatransaksi = DB::table('t_meter')
        ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
        ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
        ->join('m_harga', 'm_harga.id_harga', '=', 't_meter.id_harga')
        ->where('id',$id)
        ->get();
    
            return view('/cetak/print', ['datatransaksi' => $datatransaksi]);
        }

function viewreportthermal($id){

            $datatransaksi = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
            ->join('m_harga', 'm_harga.id_harga', '=', 't_meter.id_harga')
            ->where('id',$id)
            ->get();
        
                return view('/cetak/printthermal', ['datatransaksi' => $datatransaksi]);
            }

}
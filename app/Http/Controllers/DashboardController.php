<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\M_Pelanggan;
use App\Models\M_Class;
use Session;

class DashboardController extends Controller
{
    
function Index(){

    $jumlah_pelanggan = M_Pelanggan::selectRaw('count(*) as total')->first()->total;

    $total_saldo_pelanggan = M_Pelanggan::selectRaw('sum(total_saldo) as total')->first()->total;

    $data = M_Pelanggan::select('rt')
    ->groupBy('rt')
    ->get();

        foreach ($data as $key) {
            $data_pelanggan[] = $key->rt;
        }

    $datakelas = M_Class::select('keterangan')
    ->groupBy('keterangan')
    ->get();

        foreach ($datakelas as $key) {
            $data_class[] = $key->keterangan;
        }

//     $dumpData = DB::table('m_pelanggan')
//     ->join('m_class', 'm_class.id_class', '=', 'm_pelanggan.id_class')
//     ->where('id_pelanggan', $id_pelanggan)
//     ->selectRaw('id_pelanggan,count(id_pelanggan),rt')
//     ->groupBy('rt')
//     ->get();

// dd($dumpData->toArray());

    // $data_class = M_pelanggan::select('id_class')
    // ->groupBy('id_class')
    // ->get();
 
    	return view('/dashboard/index',
        [
            'jumlah_pelanggan' => $jumlah_pelanggan,
            'total_saldo_pelanggan' => $total_saldo_pelanggan,
            'data_pelanggan' => $data_pelanggan,
            'data_class' => $data_class
            // 'user_rt' => $dumpData,
            // 'data_class' => $data_class,
        ]
    );
    }

}
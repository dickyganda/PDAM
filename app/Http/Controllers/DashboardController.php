<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\M_Pelanggan;
use App\Models\M_Class;
use App\Models\T_Meter;
use Session;

class DashboardController extends Controller
{
    
function Index(){

    // menghitung jumlah pelanggan
    $jumlah_pelanggan = M_Pelanggan::selectRaw('count(*) as total')->first()->total;
    
    // menghitung jumlah total tunggakan
    $total_saldo_tunggakan = M_Pelanggan::selectRaw('sum(total_saldo) as total')->first()->total;

    // menampilkan total tunggakan per pelanggan
    $total_saldo_pelanggan = DB::table('m_pelanggan')
    ->where('total_saldo', '>', 0)
    ->get();
    // dd($total_saldo_pelanggan);

    // mengambil nama rt untuk chart
    $data = M_Pelanggan::select('rt')
    ->groupBy('rt')
    ->get();

        foreach ($data as $key) {
            $data_pelanggan[] = $key->rt;
        }

        // mengambil nama kelas untuk chart
    $datakelas = M_Class::select('keterangan')
    ->groupBy('keterangan')
    ->get();

        foreach ($datakelas as $key) {
            $data_class[] = $key->keterangan;
        }

        $pengguna_kelas = DB::table('m_pelanggan')
        ->select('id_class', DB::raw('count(*) as total'))
        ->groupBy('id_class')
        ->get();
    // dd($pengguna_kelas);

    $pengguna_rt = DB::table('m_pelanggan')
        ->select('rt', DB::raw('count(*) as total'))
        ->groupBy('rt')
        ->get();
        // dd($pengguna_rt);

    	return view('/dashboard/index',
        [
            'jumlah_pelanggan' => $jumlah_pelanggan,
            'total_saldo_tunggakan' => $total_saldo_tunggakan,
            'total_saldo_pelanggan' => $total_saldo_pelanggan,
            'data_pelanggan' => $data_pelanggan,
            'data_class' => $data_class,
            'pengguna_kelas' => $pengguna_kelas,
            'pengguna_rt' => $pengguna_rt,
        ]
    );
    }

    // function hitungtotalsaldo($id_pelanggan){
    //     $total_saldo_tunggakan = T_Meter::selectRaw('id_pelanggan','saldo', 'sum(saldo) as total')
    //     ->where('id_pelanggan', $id_pelanggan)
    //     ->get()->total;

    //     dd($total_saldo_tunggakan);

    //     return view('/dashboard/index',
    //     [
    //         'total_saldo_tunggakan' => $total_saldo_tunggakan,
    //     ]
    // );
    // }

}
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

    // public function __construct()
    // {
    //     $this->middleware('auth:Administrator');
    // }

function Index(){

    // menghitung jumlah pelanggan
    $jumlah_pelanggan = M_Pelanggan::selectRaw('count(*) as total')->first()->total;
    
    // menghitung jumlah total tunggakan
    $total_saldo_tunggakan = T_Meter::selectRaw('sum(saldo) as total')->first()->total;

    // menampilkan total tunggakan per rt
    $total_saldo_rt = DB::table('t_meter')
    ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
    ->select('m_pelanggan.rt','t_meter.saldo', DB::raw('sum(saldo) as total'))
    ->groupBy('rt')
    ->get();
    // dd($total_saldo_rt);

    // mengambil nama rt untuk chart
    $datart = M_Pelanggan::select('rt')
    ->groupBy('rt')
    ->get();
    // dd($datart);

        foreach ($datart as $key) {
            $data_rt[] = $key->rt;
        }

        // mengambil nama kelas untuk chart
    $datakelas = M_Class::select('keterangan')
    ->groupBy('keterangan')
    ->get();

        foreach ($datakelas as $key) {
            $data_class[] = $key->keterangan;
        }

        // menghitung jumlah pengguna setiap kelas
        $pengguna_kelas = DB::table('m_pelanggan')
        ->join('m_class', 'm_pelanggan.id_class', '=', 'm_class.id_class')
        ->select('m_class.keterangan', DB::raw('count(*) as total'))
        // ->groupBy('id_class')
        ->get();
    // dd($pengguna_kelas);

    $pengguna_rt = DB::table('m_pelanggan')
        ->select('*', DB::raw('count(*) as total'))
        ->groupBy('rt')
        ->get();
        // dd($pengguna_rt);

    	return view('/dashboard/index',
        [
            'jumlah_pelanggan' => $jumlah_pelanggan,
            'total_saldo_tunggakan' => $total_saldo_tunggakan,
            'total_saldo_rt' => $total_saldo_rt,
            'data_rt' => $data_rt,
            'data_class' => $data_class,
            'pengguna_kelas' => $pengguna_kelas,
            'pengguna_rt' => $pengguna_rt,
        ]
    );
    }

}
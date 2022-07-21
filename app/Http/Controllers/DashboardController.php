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

    // menghitung jumlah pelanggan
    $jumlah_pelanggan = M_Pelanggan::selectRaw('count(*) as total')->first()->total;
    
    // menghitung jumlah total tunggakan
    $total_saldo_pelanggan = M_Pelanggan::selectRaw('sum(total_saldo) as total')->first()->total;

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
            'total_saldo_pelanggan' => $total_saldo_pelanggan,
            'data_pelanggan' => $data_pelanggan,
            'data_class' => $data_class,
            'pengguna_kelas' => $pengguna_kelas,
            'pengguna_rt' => $pengguna_rt,
        ]
    );
    }

}
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

    $data_rt = M_pelanggan::select('rt')
    ->groupBy('rt')
    ->count();
    // dd($data_rt);

    // $datart = DB::select("
        
    //         select count(id_class) total
    //         from m_pelanggan
            
    //         right join (
    //             select id_pelanggan, rt
    //             from m_pelanggan
    //         )
            
    //         group by p.id_pelanggan
    //         order by p.id_pelanggan
    //     ");

    //     foreach ($datart as $key) {
    //         $total_pengguna_rt[] = $key->total;
    //     }
        // dd($total_pengguna_rt);

    // $data_kelas = M_Pelanggan::select('id_class'('count(*) as total'))
    // ->groupBy('id_class')
    // ->first()->total;
    // dd($data_kelas);

        // menghitung jumlah pengguna kelas
    // $jumlahkelas = DB::table('m_pelanggan')
    // ->join('m_class', 'm_class.id_class', '=', 'm_pelanggan.id_class')
    // ->selectRaw('count(id_pelanggan) as total')
    // ->where()
    // ->groupBy('id_pelanggan')
    // ->first()->total;
    // dd($jumlahkelas);
 
    	return view('/dashboard/index',
        [
            'jumlah_pelanggan' => $jumlah_pelanggan,
            'total_saldo_pelanggan' => $total_saldo_pelanggan,
            'data_pelanggan' => $data_pelanggan,
            'data_class' => $data_class,
            'data_rt' => $data_rt,
            // 'total_pengguna_rt' => $total_pengguna_rt,
            // 'data_kelas' => $data_kelas,
        ]
    );
    }

}
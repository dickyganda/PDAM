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

    function Index()
    {

        // menghitung jumlah pelanggan
        $jumlah_pelanggan = M_Pelanggan::selectRaw('count(*) as total')->first()->total;

        // menghitung jumlah total tunggakan
        $total_saldo_tunggakan = T_Meter::selectRaw('sum(saldo) as total')->first()->total;

        $total_tagihan = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('m'))
            ->first()->total;
        // dd($total_tagihan);

        // menampilkan total tunggakan per rt
        $total_saldo_rt = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->select('m_pelanggan.rt', 't_meter.saldo', DB::raw('sum(saldo) as total'))
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
        foreach ($pengguna_kelas as $key) {
            $penggunakelas[] = $key->total;
        }
        // dd($pengguna_kelas);

        $pengguna_rt = DB::table('m_pelanggan')
            ->select('rt', DB::raw('count(*) as total'))
            ->groupBy('rt')
            ->get();
        foreach ($pengguna_rt as $key) {
            $penggunart[] = $key->total;
        }
        // dd($pengguna_rt);

        // hitung total saldo per bulan
        $total_saldo_januari = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('01'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_februari = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('02'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_maret = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('03'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_april = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('04'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_mei = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('05'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_juni = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('06'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_juli = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('07'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_agustus = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('08'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_september = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('09'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_oktober = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('10'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_november = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('11'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;

        $total_saldo_desember = T_Meter::selectRaw('sum(saldo) as total')
            ->whereMonth('tgl_scan', date('12'))
            ->whereYear('tgl_scan', date('Y'))
            ->first()->total;
        // dd($total_saldo_januari);

        return view(
            '/dashboard/index',
            [
                'jumlah_pelanggan' => $jumlah_pelanggan,
                'total_saldo_tunggakan' => $total_saldo_tunggakan,
                'total_saldo_rt' => $total_saldo_rt,
                'data_rt' => $data_rt,
                'data_class' => $data_class,
                'pengguna_kelas' => $pengguna_kelas,
                'pengguna_rt' => $pengguna_rt,
                'penggunart' => $penggunart,
                'penggunakelas' => $penggunakelas,
                'total_tagihan' => $total_tagihan,
                'total_saldo_januari' => $total_saldo_januari,
                'total_saldo_februari' => $total_saldo_februari,
                'total_saldo_maret' => $total_saldo_maret,
                'total_saldo_april' => $total_saldo_april,
                'total_saldo_mei' => $total_saldo_mei,
                'total_saldo_juni' => $total_saldo_juni,
                'total_saldo_juli' => $total_saldo_juli,
                'total_saldo_agustus' => $total_saldo_agustus,
                'total_saldo_september' => $total_saldo_september,
                'total_saldo_oktober' => $total_saldo_oktober,
                'total_saldo_november' => $total_saldo_november,
                'total_saldo_desember' => $total_saldo_desember,
            ]
        );
    }
}

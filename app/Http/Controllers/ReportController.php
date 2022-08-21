<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Meter;
use App\Models\M_Class;

class ReportController extends Controller
{

    function Index()
    {

        $datatransaksi = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
            ->get();

        $datapelanggan = DB::table('m_pelanggan')
            ->groupBy('rt')
            ->get();

        $class_bawah = M_Class::select('harga_class')
            ->where('keterangan', '=', '<=10')
            ->first();
        // dd($class_bawah);

        $class_atas = M_Class::select('harga_class')
            ->where('keterangan', '=', '>10')
            ->first();

        // dd($datatransaksi);

        return view(
            '/report/index',
            [
                'datatransaksi' => $datatransaksi,
                'datapelanggan' => $datapelanggan,
                'class_bawah' => $class_bawah,
                'class_atas' => $class_atas,
            ]
        );
    }

    public function edittransaksi($id)
    {
        $datatransaksi = DB::table('t_meter')->where('id', $id)->get();

        return view('/datatransaksi/edittransaksi', ['datatransaksi' => $datatransaksi]);
    }

    public function updatetransaksi(Request $request)
    {
        $datasaldo = T_Meter::select('saldo')
            ->where('id', $request->id)
            ->first();
        // dd($datasaldo);

        DB::table('t_meter')->where('id', $request->id)->update([
            'status' => $request->status,
            'biaya_admin' => $request->biaya_admin,
            'biaya_perawatan' => $request->biaya_perawatan,
            'pembayaran' => $request->pembayaran,
            'saldo' => $datasaldo->saldo - $request->pembayaran,
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function hitungsaldo($id)
    {

        $saldo = DB::table('t_meter')
            ->where('id', $id)
            ->sum(DB::raw('tagihan + biaya_admin + biaya_perawatan + tunggakan'));

        // dd($saldo);

        $saldo = DB::table('t_meter')
            ->where('id', $id)
            ->update(['saldo' => $saldo]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    function updatetunggakan($id)
    {

        $jumlah_tunggakan = T_Meter::select('id', 'saldo')
            ->where('saldo', '>', '0')
            ->where('id', $id)
            ->whereMonth('tgl_scan', '<', date('m'))
            ->first();
        // dd($jumlah_tunggakan);

        DB::table('t_meter')->where('id', $id)->update([
            'tunggakan' => $jumlah_tunggakan->saldo,
            'saldo' => 0,
        ]);
        // dd($jumlah_tunggakan);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    function printpreview(Request $request)
    {

        $filter_min = $request->get('filterdatemin');
        $filter_max = $request->get('filterdatemax');
        $filter_rt = $request->get('filter_rt');
        // dd($filter_rt);
        $timestamp = strtotime($filter_min);
        $filter_min = date("Y-m-d", $timestamp);
        $timestamp = strtotime($filter_max);

        // Create the new format from the timestamp

        $filter_max = date("Y-m-d", $timestamp);

        $datatransaksi = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
            ->where('tgl_scan', '<=', $filter_max)
            ->where('tgl_scan', '>=', $filter_min);
        if (!empty($filter_rt)) {
            $datatransaksi = $datatransaksi->where('rt', '=', $filter_rt);
        }
        $datatransaksi = $datatransaksi->get();
        // dd($datatransaksi);

        $class_bawah = M_Class::select('harga_class')
            ->where('keterangan', '=', '<=10')
            ->first();
        $class_bawah = $class_bawah->harga_class;
        // dd($class_bawah);

        $class_atas = M_Class::select('harga_class')
            ->where('keterangan', '=', '>10')
            ->first();
        $class_atas = $class_atas->harga_class;

        // dd($filter_min);
        foreach ($datatransaksi as $key => $value) {
            $jumlah_pemakaian = $value->pemakaian;

            $batas_pemakaian = 10;
            if ($jumlah_pemakaian <= $batas_pemakaian) {
                $jumlah_pemakaian_bawah = $jumlah_pemakaian;
                $jumlah_pemakaian_atas = 0;
            } else {
                $jumlah_pemakaian_bawah = 10;
                $jumlah_pemakaian -= 10;
                $jumlah_pemakaian_atas = $jumlah_pemakaian;
            }

            $biaya_pemakaian_bawah = $jumlah_pemakaian_bawah * $class_bawah;
            $biaya_pemakaian_atas = $jumlah_pemakaian_atas * $class_atas;

            $array = [
                'jumlah_pemakaian_atas' => $jumlah_pemakaian_atas,
                'jumlah_pemakaian_bawah' => $jumlah_pemakaian_bawah,
                'biaya_pemakaian_bawah' => $biaya_pemakaian_bawah,
                'biaya_pemakaian_atas' => $biaya_pemakaian_atas,
            ];
            $data = (array) $datatransaksi[$key];

            $datatransaksi[$key] = array_merge($data, $array);
            // dd($datatransaksi[$key]);
        }

        $datatransaksi = (object) $datatransaksi;


        return view(
            '/report/print_preview',
            [
                'datatransaksi' => $datatransaksi,
                'class_bawah' => $class_bawah,
                'class_atas' => $class_atas,
                'jumlah_pemakaian_bawah' => $jumlah_pemakaian_bawah,
                'jumlah_pemakaian_atas' => $jumlah_pemakaian_atas,

            ]
        );
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use File;
use Response;

use App\Imports\T_Meter_Import;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\T_Meter;
use App\Models\M_Class;

class DatatransaksiController extends Controller
{

    function Index()
    {

        $datatransaksi = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
            ->get();
        // dd($datatransaksi);

        $datapelanggan = DB::table('m_pelanggan')
            ->groupBy('rt')
            ->get();

        // dd($datatransaksi);

        return view(
            '/datatransaksi/index',
            [
                'datatransaksi' => $datatransaksi,
                'datapelanggan' => $datapelanggan,
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
            'sisa_bayar' => $request->sisa_bayar,
        ]);
        // dd($request);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    function viewreport($id)
    {

        $datatransaksi = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
            ->where('id', $id)
            ->get();

        $class_bawah = M_Class::select('harga_class')
            ->where('keterangan', '=', '<=10')
            ->first();
        $class_bawah = $class_bawah->harga_class;
        // dd($class_bawah);

        $class_atas = M_Class::select('harga_class')
            ->where('keterangan', '=', '>10')
            ->first();
        $class_atas = $class_atas->harga_class;

        $jumlah_pemakaian = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
            ->select('pemakaian')
            ->where('id', $id)
            ->first();
        // dd($jumlah_pemakaian_bawah);
        $jumlah_pemakaian = $jumlah_pemakaian->pemakaian;

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

        // dd($class_bawah, $class_atas,$jumlah_pemakaian_bawah,$jumlah_pemakaian_atas,$biaya_pemakaian_bawah, $biaya_pemakaian_atas);

        // $jumlah_tagihan_bawah = $jumlah_pemakaian_bawah->pemakaian * $class_bawah->harga_class;



        return view('/cetak/print', [
            'datatransaksi' => $datatransaksi,
            'class_bawah' => $class_bawah,
            'class_atas' => $class_atas,
            'jumlah_pemakaian_bawah' => $jumlah_pemakaian_bawah,
            'jumlah_pemakaian_atas' => $jumlah_pemakaian_atas,
            'biaya_pemakaian_bawah' => $biaya_pemakaian_bawah,
            'biaya_pemakaian_atas' => $biaya_pemakaian_atas,
            // 'jumlah_tagihan_bawah' => $jumlah_tagihan_bawah,

        ]);
    }

    function viewreportthermal($id)
    {

        $datatransaksi = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
            ->where('id', $id)
            ->get();

        $class_bawah = M_Class::select('harga_class')
            ->where('keterangan', '=', '<=10')
            ->first();
        // dd($class_bawah);

        $class_atas = M_Class::select('harga_class')
            ->where('keterangan', '=', '>10')
            ->first();

        return view('/cetak/printthermal', [
            'datatransaksi' => $datatransaksi,
            'class_bawah' => $class_bawah,
            'class_atas' => $class_atas,
        ]);
    }

    public function hitungsaldo($id)
    {

        $saldo = DB::table('t_meter')
            ->where('id', $id)
            ->sum(DB::raw('tagihan + biaya_admin + biaya_perawatan + tunggakan - sisa_bayar'));
        $saldo = intval($saldo);
        // dd($saldo);

        $saldo = DB::table('t_meter')
            ->where('id', $id)
            ->update([
                'saldo' => $saldo,
                'sisa_bayar' => 0,
            ]);
        // dd($saldo);
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

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_t_meter', $nama_file);

        // import data
        Excel::import(new T_Meter_Import, public_path('/file_t_meter/' . $nama_file));

        // notifikasi dengan session
        Session::flash('sukses', 'Data Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('/datatransaksi/index');
    }
}

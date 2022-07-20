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
    ->get();

    	return view('/datatransaksi/index', ['datatransaksi' => $datatransaksi]);
    }

    public function edittransaksi($id)
    {
        $datatransaksi = DB::table('t_meter')->where('id',$id)->get();

        return view('/datatransaksi/edittransaksi',['datatransaksi' => $datatransaksi]);
    
    }

    public function updatetransaksi(Request $request)
{
    $datasaldo = T_Meter::select('saldo')
    ->where('id', $request->id)
    ->first();
    // dd($datasaldo);

	DB::table('t_meter')->where('id',$request->id)->update([
		'status' => $request->status,
        'biaya_admin' => $request->biaya_admin,
        'biaya_perawatan' => $request->biaya_perawatan,
        'pembayaran' => $request->pembayaran,
        'saldo' => $datasaldo->saldo - $request->pembayaran,
	]);

    // if(Date('Y-m-d') > $tgl_scan){

    // }
    // if($datasaldo->saaldo > 0){
    //     DB::table('t_meter')->where('id',$request->id)->update([
    //         'tunggakan' => $datasaldo->saldo,
    //         'saldo' => $datasaldo->saldo - $datasaldo->saldo,
    //     ]);
    // }

    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

function viewreport($id){

        $datatransaksi = DB::table('t_meter')
        ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
        ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
        ->where('id',$id)
        ->get();
    
            return view('/cetak/print', ['datatransaksi' => $datatransaksi]);
        }

function viewreportthermal($id){

            $datatransaksi = DB::table('t_meter')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
            ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
            // ->join('m_harga', 'm_harga.id_harga', '=', 't_meter.id_harga')
            ->where('id',$id)
            ->get();
        
                return view('/cetak/printthermal', ['datatransaksi' => $datatransaksi]);
            }

public function hitungsaldo($id)
    {
        
    $saldo = DB::table('t_meter')
    ->where('id', $id)
    ->sum(DB::raw('tagihan + biaya_admin + biaya_perawatan + tunggakan'));

    // dd($saldo);

    $saldo = DB::table('t_meter')
    ->where('id', $id)
    ->update(['saldo'=>$saldo]);

    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
    }

}
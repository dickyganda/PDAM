<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use File;
use Response;

use App\Models\T_Meter;

class DatatransaksiController extends Controller
{
    
function Index(){

    $datatransaksi = DB::table('t_meter')
    ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
    ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
    ->get();
    // dd($datatransaksi);

    $datapelanggan = DB::table('m_pelanggan')
    ->groupBy('rt')
    ->get();

    // dd($datatransaksi);

    	return view('/datatransaksi/index', 
        ['datatransaksi' => $datatransaksi,
        'datapelanggan' =>$datapelanggan,
    ]);
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
        'sisa_bayar' => $request->sisa_bayar,
	]);

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
            ->where('id',$id)
            ->get();
        
                return view('/cetak/printthermal', ['datatransaksi' => $datatransaksi]);
            }

public function hitungsaldo($id)
    {
        
    $saldo = DB::table('t_meter')
    ->where('id', $id)
    ->sum(DB::raw('tagihan + biaya_admin + biaya_perawatan + tunggakan - sisa_bayar'));
$saldo =intval($saldo);
    // dd($saldo);

    $saldo = DB::table('t_meter')
    ->where('id', $id)
    ->update(['saldo'=>$saldo,
    'sisa_bayar' => 0,]);
// dd($saldo);
    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
    }

    function updatetunggakan($id){
    
        $jumlah_tunggakan = T_Meter::select('id', 'saldo')
        ->where('saldo', '>', '0')
        ->where('id', $id)
        ->whereMonth('tgl_scan', '<', date('m'))
        ->first();
        // dd($jumlah_tunggakan);
    
        DB::table('t_meter')->where('id',$id)->update([
            'tunggakan' => $jumlah_tunggakan->saldo,
            'saldo' => 0,
        ]);
    // dd($jumlah_tunggakan);
    
    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
        }

    // public function getPubliclyStorgeFile($link_image)

    //     {
    //         $path = storage_path('app/public/image/'. $link_image);
        
    //         if (!File::exists($path)) {
    //             abort(404);
    //         }
        
    //         $file = File::get($path);
    //         $type = File::mimeType($path);
        
    //         $response = Response::make($file, 200);
        
    //         $response->header("Content-Type", $type);
        
    //         return $response;
        
    //     }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Meter;

class ReportController extends Controller
{
    
function Index(){

    $datatransaksi = DB::table('t_meter')
    ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
    ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
    ->get();

    $datapelanggan = DB::table('m_pelanggan')->get();

    // dd($datatransaksi);

    	return view('/report/index', 
        ['datatransaksi' => $datatransaksi,
        'datapelanggan' => $datapelanggan,
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
    ->sum(DB::raw('tagihan + biaya_admin + biaya_perawatan + tunggakan'));

    // dd($saldo);

    $saldo = DB::table('t_meter')
    ->where('id', $id)
    ->update(['saldo'=>$saldo]);

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

function filter_rt($id){

            $datapelanggan = DB::table('m_pelanggan')->get();

            $datatransaksi = DB::table('t_meter')->where('id',$id)
            ->groupBy('rt')
            ->get();
            
            // $dataclass = DB::table('m_class')->get();
         
            return view('/report/filter_rt', 
            ['datapelanggan' => $datapelanggan,
            'datatransaksi' => $datatransaksi
        ]);
            }

            function printpreview($id){

                $datapelanggan = DB::table('m_pelanggan')->get();
    
                $datatransaksi = DB::table('t_meter')->where('id',$id)
                ->groupBy('rt')
                ->get();
                
                // $dataclass = DB::table('m_class')->get();
             
                return view('/report/print_preview', 
                ['datapelanggan' => $datapelanggan,
                'datatransaksi' => $datatransaksi
            ]);
                }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Pelanggan;
use App\Models\M_Class;
use App\Models\T_Meter;

class DatamasterpelangganController extends Controller
{
    
    function Index(){

    $datapelanggan = DB::table('m_pelanggan')
    ->join('m_class', 'm_class.id_class', '=', 'm_pelanggan.id_class')->get();
    
    $dataclass = DB::table('m_class')->get();

    $data_status_pelanggan = DB::table('m_pelanggan')
    ->groupBy('status_pelanggan')
    ->get();

    $data_pelanggan = DB::table('m_pelanggan')
    ->groupBy('rt')
    ->get();
 
    	return view('datamasterpelanggan/index' ,
        ['datapelanggan' => $datapelanggan, 'dataclass' => $dataclass,
        'data_status_pelanggan' => $data_status_pelanggan,
        'data_pelanggan' => $data_pelanggan,

    ]);
    }

    function tambahpelanggan(Request $request){
        $dataconfig = DB::table('m_config')
        ->where('nama_config','running_number_sequence')
        ->first();

        $add = new M_Pelanggan;
        $add->id_pelanggan = $request->input('id_pelanggan');
        $add->kode_pelanggan = $request->input('rt').$request->input('id_class').str_pad(($dataconfig->nilai_config+1),4, '0', STR_PAD_LEFT);
        $add->nama = $request->input('nama');
        $add->alamat = $request->input('alamat');
        $add->status_pelanggan = $request->input('status_pelanggan');
        $add->tgl_add_pelanggan =  Date('Y-m-d');
        // $add->tgl_edit = $request->input('tgl_edit');
        $add->rt = $request->input('rt');
        $add->id_class = $request->input('id_class');
        $add->no_sambung = $request->input('no_sambung');
        $add->save();
        DB::table('m_config')->where('nama_config','running_number_sequence')->update([
            'nilai_config' => ($dataconfig->nilai_config+1),
        ]);

        // dd($add);
        
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function editpelanggan($id_pelanggan)
    {
        $datapelanggan = DB::table('m_pelanggan')->where('id_pelanggan',$id_pelanggan)->get();

        return view('/datamasterpelanggan/editpelanggan',['datapelanggan' => $datapelanggan]);
    
    }

    public function updatepelanggan(Request $request)
{
	DB::table('m_pelanggan')->where('id_pelanggan',$request->id_pelanggan)->update([
		'status_pelanggan' => $request->status_pelanggan,
        'tgl_edit_pelanggan' => Date('Y-m-d')

	]);
    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

public function deletepelanggan($id_pelanggan)
{
	// menghapus data warga berdasarkan id yang dipilih
	DB::table('m_pelanggan')->where('id_pelanggan',$id_pelanggan)->delete();
		
	return response()->json(array('status'=> 'success', 'reason' => 'Sukses Hapus Data'));
}

function hitungtotalsaldo(Request $request){
    $total_saldo = DB::table('t_meter')
    ->where('id', $request->id_pelanggan)
    ->sum(DB::raw('tunggakan'))
    ->groupBy('id_pelanggan');

    // dd($total_saldo);

    $total_saldo = DB::table('m_pelanggan')
    ->where('id_pelanggan', $request->id_pelanggan)
    ->update(['total_saldo'=>$total_saldo]);

    // dd($total_saldo);
    return view('/dashboard/index',
    [
        'total_saldo' => $total_saldo,
    ]
);
}

}
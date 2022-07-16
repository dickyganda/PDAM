<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Pelanggan;
use App\Models\M_Class;

class DatamasterpelangganController extends Controller
{
    
    function Index(){

    $datapelanggan = DB::table('m_pelanggan')
    ->join('m_class', 'm_class.id_class', '=', 'm_pelanggan.id_class')->get();
    
    $dataclass = DB::table('m_class')->get();
 
    	return view('datamasterpelanggan/index' ,['datapelanggan' => $datapelanggan, 'dataclass' => $dataclass]);
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
        $add->tgl_add_pelanggan =  Date('Y-m-d H:i:s');
        // $add->tgl_edit = $request->input('tgl_edit');
        $add->rt = $request->input('rt');
        $add->id_class = $request->input('id_class');
        $add->no_sambung = $request->input('no_sambung');
        $add->save();
        DB::table('m_config')->where('nama_config','running_number_sequence')->update([
            'nilai_config' => ($dataconfig->nilai_config+1),
        ]);
        
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
        'tgl_edit_pelanggan' => Date('Y-m-d H:i:s')

	]);
    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

public function deletepelanggan($id_pelanggan)
{
	// menghapus data warga berdasarkan id yang dipilih
	DB::table('m_pelanggan')->where('id_pelanggan',$id_pelanggan)->delete();
		
	return response()->json(array('status'=> 'success', 'reason' => 'Sukses Hapus Data'));
}

}
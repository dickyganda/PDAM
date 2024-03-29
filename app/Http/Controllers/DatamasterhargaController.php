<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Harga;

class DatamasterhargaController extends Controller
{
    
function Index(){

    $dataharga = DB::table('m_harga')
    ->join('m_class', 'm_class.id_class', '=', 'm_harga.id_class')
    ->join('m_user', 'm_user.id_user', '=', 'm_harga.id_user')
    ->get();

    $data_status_harga = DB::table('m_harga')
    ->groupBy('status_harga')
    ->get();

    $data_user = DB::table('m_user')
    ->groupBy('user')
    ->get();

    $data_keterangan_class = DB::table('m_class')
    ->join('m_harga', 'm_harga.id_class', '=', 'm_class.id_class')
    ->groupBy('m_class.keterangan')
    ->get();
 
    	return view('datamasterharga/index',[
        'dataharga' => $dataharga,
        'data_status_harga' => $data_status_harga,
        'data_user' => $data_user,
        'data_keterangan_class' => $data_keterangan_class,
    ]);
    }

    function tambahharga(Request $request){

        DB::table('m_harga')->where('id_class',$request->id_class)->update([
            'status_harga' => 0,
            'tgl_edit_harga' => Date('Y-m-d')
        ]);

        $add = new M_Harga;
        $add->id_harga = $request->input('id_harga');
        $add->id_user = $request->input('id_user');
        $add->harga = $request->input('harga');
        $add->id_class = $request->input('id_class');
        $add->status_harga = $request->input('status_harga');
        $add->tgl_add_harga = Date('Y-m-d');
        // $add->tgl_edit = $request->input('tgl_edit');
        $add->save();

        DB::table('m_class')->where('id_class',$request->id_class)->update([
            'harga_class' => $request->harga,
            'tgl_edit_class' => Date('Y-m-d')
        ]);

        DB::table('m_harga')->where('id_harga',$request->id_harga)->update([
            'status_harga' => $request->harga,
            'tgl_edit_harga' => Date('Y-m-d')
        ]);
        
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function editharga($id_harga)
    {
        $dataharga = DB::table('m_harga')->where('id_harga',$id_harga)->get();

        return view('/datamasterharga/editharga',['dataharga' => $dataharga]);
    
    }

    public function updateharga(Request $request)
{
	DB::table('m_harga')->where('id_harga',$request->id_harga)->update([
		'status_harga' => $request->status_harga,
        'tgl_edit_harga' => Date('Y-m-d')
	]);

    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

public function deleteharga($id_harga)
{
	// menghapus data warga berdasarkan id yang dipilih
	DB::table('m_harga')->where('id_harga',$id_harga)->delete();
		
	return response()->json(array('status'=> 'success', 'reason' => 'Sukses Hapus Data'));
}

}
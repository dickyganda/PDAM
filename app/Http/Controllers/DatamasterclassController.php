<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Class;

class DatamasterclassController extends Controller
{
    
function Index(){

    $dataclass = DB::table('m_class')->get();

    $data_status_class = DB::table('m_class')
    ->groupBy('status_class')
    ->get();
 
    	return view('/datamasterclass/index',['dataclass' => $dataclass,
        'data_status_class' => $data_status_class,
    ]);
    }

    function tambahclass(Request $request){
        $add = new M_Class;
        $add->id_class = $request->input('id_class');
        $add->keterangan = $request->input('keterangan');
        $add->harga_class = $request->input('harga_class');
        $add->status_class = $request->input('status_classs');
        $add->tgl_add_class = Date('Y-m-d');
        // $add->tgl_edit = $request->input('tgl_edit');
        $add->save();
        
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function editclass($id_class)
    {
        $dataclass = DB::table('m_class')->where('id_class',$id_class)->get();

        return view('/datamasterclass/editclass',['dataclass' => $dataclass]);
    
    }

    public function updateclass(Request $request)
{
	DB::table('m_class')->where('id_class',$request->id_class)->update([
        'harga_class' => $request->harga_class,
		'status_class' => $request->status_class,
        'tgl_edit_class' => Date('Y-m-d'),
	]);

    // dd($request);

    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

public function deleteclass($id_class)
{
	// menghapus data warga berdasarkan id yang dipilih
	DB::table('m_class')->where('id_class',$id_class)->delete();
		
	return response()->json(array('status'=> 'success', 'reason' => 'Sukses Hapus Data'));
}

}
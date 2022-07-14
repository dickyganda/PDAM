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
 
    	return view('/datamasterclass/index',['dataclass' => $dataclass]);
    }

    function tambahclass(Request $request){
        $add = new M_Class;
        $add->id_class = $request->input('id_class');
        $add->keterangan = $request->input('keterangan');
        $add->harga = $request->input('harga');
        $add->status = $request->input('status');
        $add->tgl_add = Date('Y-m-d');
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
        'harga' => $request->harga,
		'status' => $request->status,
        'tgl_edit' => Date('Y-m-d'),
	]);

    // dd($request);

    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

}
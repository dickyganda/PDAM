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
 
    	return view('datamasterharga/index',['dataharga' => $dataharga]);
    }

    function tambahharga(Request $request){
        $add = new M_Harga;
        $add->id_harga = $request->input('id_harga');
        $add->id_user = $request->input('id_user');
        $add->harga = $request->input('harga');
        $add->id_class = $request->input('id_class');
        $add->status = $request->input('status');
        $add->tgl_add = Date('Y-m-d');
        $add->tgl_edit = $request->input('tgl_edit');
        $add->save();
        
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

}
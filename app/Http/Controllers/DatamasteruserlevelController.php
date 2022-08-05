<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_User_Level;

class DatamasteruserlevelController extends Controller
{
    
function Index(){

    $datauserlevel = DB::table('m_user_level')->get();

    $data_status_userlevel = DB::table('m_user_level')
    ->groupBy('status_aktif')
    ->get();
 
    	return view('/datamasteruserlevel/index', 
        ['datauserlevel' => $datauserlevel,
    'data_status_userlevel' => $data_status_userlevel]);
    }

    function tambahuserlevel(Request $request){
        $add = new M_User_Level;
        $add->id_level = $request->input('id_level');
        $add->nama_level = $request->input('nama_level');
        $add->status_aktif = $request->input('status_aktif');
        $add->akses_web = $request->input('akses_web');
        $add->akses_mobile = $request->input('akses_mobile');
        $add->save();
        
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function edituserlevel($id_level)
    {
        $datauserlevel = DB::table('m_user_level')->where('id_level',$id_level)->get();

        return view('/datamasteruserlevel/edituserlevel',['datauserlevel' => $datauserlevel]);
    
    }

    public function updateuserlevel(Request $request)
{
	DB::table('m_user_level')->where('id_level',$request->id_level)->update([
		'status_aktif' => $request->status_aktif,
	]);

    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

public function deleteuserlevel($id_level)
{
	// menghapus data warga berdasarkan id yang dipilih
	DB::table('m_user_level')->where('id_level',$id_level)->delete();
		
	return response()->json(array('status'=> 'success', 'reason' => 'Sukses Hapus Data'));
}

}
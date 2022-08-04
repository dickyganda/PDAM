<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

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

}
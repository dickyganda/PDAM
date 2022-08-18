<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_User;

class DatamasteruserController extends Controller
{
    
function Index(){

    $datauser = DB::table('m_user')
    ->join('m_user_level', 'm_user_level.id_level', '=', 'm_user.id_level')
    ->get();

    $data_status_user = DB::table('m_user')
    ->groupBy('status_user')
    ->get();
 
    	return view('/datamasteruser/index', ['datauser' => $datauser,
        'data_status_user' => $data_status_user],);
    }

    function tambahuser(Request $request){
        $add = new M_User;
        $add->id_user = $request->input('id_user');
        $add->user = $request->input('user');
        $add->email = $request->input('email');
        $add->password = md5($request->input('password'));
        // $add->pengingat = $request->input('pengingat');
        $add->nama = $request->input('nama');
        $add->id_level = $request->input('id_level');
        $add->status_user = $request->input('status_user');
        $add->tgl_daftar = Date('Y-m-d');
        // $add->tgl_password = $request->input('tgl_password');
        $add->save();
        
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function edituser($id_user)
    {
        $datauser = DB::table('m_user')->where('id_user',$id_user)->get();

        return view('/datamasteruser/edituser',['datauser' => $datauser]);
    
    }

    public function updateuser(Request $request)
{
	DB::table('m_user')->where('id_user',$request->id_user)->update([
		'status_user' => $request->status_user,
        'password' => md5($request->password),
        'tgl_password' => Date('Y-m-d')
	]);

    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

    public function deleteuser($id_user)
{
	
	DB::table('m_user')->where('id_user',$id_user)->delete();
		
	return response()->json(array('status'=> 'success', 'reason' => 'Sukses Hapus Data'));
}

}
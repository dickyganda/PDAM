<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;
use Session;

use App\Models\T_Meter;
use App\Models\M_Pelanggan;
use App\Models\M_User;
use App\Models\M_User_Level;

class ApiController extends Controller
{

    function getdatapelanggan(M_Pelanggan $datapelanggan){
        $datapelanggan = DB::table('m_pelanggan')
    ->join('m_class', 'm_class.id_class', '=', 'm_pelanggan.id_class')->get();

    return response([
        'status' => 'Ok',
        'data' => $datapelanggan
    ]);
        }

    public function insertmeter(Request $request){

        $add = DB::table('t_meter')
        ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
        ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
        ->get();

        $dataclass = DB::table('m_class')
        ->where('id_class', $request->input('id_class'))
        ->first();

        $meterbulanlalu = T_Meter::select('stand_meter_bulan_ini')
        ->where('id_pelanggan', $request->id_pelanggan)
        ->first();

        // dd($meterbulanlalu);

        $isi_tunggakan = T_Meter::select('tunggakan')
        ->where('id_pelanggan', $request->id_pelanggan)
        ->first();

        // dd($isi_tunggakan);

        $add = new T_Meter;
        $add->id = $request->input('id');
        $add->id_pelanggan = $request->input('id_pelanggan');
        $add->id_class = $request->input('id_class');
        $add->kode_pelanggan = $request->input('kode_pelanggan');
        $add->stand_meter_bulan_lalu = ($meterbulanlalu->stand_meter_bulan_ini);
        // $add->stand_meter_bulan_lalu = $request->input('stand_meter_bulan_lalu');
        $add->stand_meter_bulan_ini = $request->input('stand_meter_bulan_ini');
        $add->pemakaian = ($request->input('stand_meter_bulan_ini') - $request->input('stand_meter_bulan_lalu'));
        $add->tagihan = ($add->pemakaian * $dataclass->harga_class);
        // $add->tunggakan = $request->input('tunggakan');
        $add->tunggakan = ($isi_tunggakan->tunggakan);
        if($request->hasFile("link_image")){
            $img = $request -> link_image;
            $img_name = time().'-'.$img->getClientOriginalName();
            Image::make($img)->save(storage_path("/app/public/".$img_name));
            $add->link_image = $img_name;
        }

        $add->tgl_scan = Date('Y-m-d');
        $add->save();
        return response([
            'status' => 'Ok',
            'message' => 'Data telah ditambahkan',
            'data' => $add
        ]);

    }

    function postlogin2(Request $request ){
        $email = $request->input('email');
        $password = $request->input('password');

        $query = DB::table('m_user')
        ->join('m_user_level', 'm_user_level.id_level', '=', 'm_user.id_level')
        ->where('email', $email)
        ->where('password' ,md5($password))
        ->first();
        if(empty($query)){
            return response()->json(array('status' => 'failed', 'reason' => 'data tidak ada'));
        }
        Session::put('nama_level',$query->nama_level);
        return response()->json(array('status' => 'success', 'reason' => 'sukses'));

    }
 
    }
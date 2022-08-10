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

    function getdatapelanggan(Request $request){
        
    // $datapelanggan = T_Meter::select('id_pelanggan', 'kode_pelanggan', 'nama', 'id_class', 'keterangan', 'stand_meter_bulan_lalu', 'stand_meter_bulan_ini')
    // ->where('kode_pelanggan', $request->kode_pelanggan)
    // ->latest('tgl_scan')
    // ->orderBy('id_pelanggan', 'desc')
    // ->first();

    $datapelanggan = DB::table('t_meter')
    ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
    ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
    ->select('m_pelanggan.kode_pelanggan', 'm_pelanggan.nama', 'm_class.keterangan', 'stand_meter_bulan_lalu', 'stand_meter_bulan_ini')
    ->where('m_pelanggan.kode_pelanggan', $request->kode_pelanggan)
    ->latest('tgl_scan')
    ->orderBy('m_pelanggan.kode_pelanggan', 'desc')
    ->first();

    return response([
        'status' => 'Ok',
        'data' => $datapelanggan
    ]);
        }

    public function insertmeter(Request $request){
$tunggakanbulanlalu = 0;

        $bulanlalu = date('m', strtotime('first day of last month'));
        $tahunnyabulanlalu = date('Y');
        if($bulanlalu == 12){
            $tahunnyabulanlalu = date('Y', strtotime('first day of last month'));
        }
        // dd($tahunnyabulanlalu);
        $scanbulanlalu = DB::table('t_meter')
        ->whereMonth('tgl_scan', '=', $bulanlalu)
        ->whereYear('tgl_scan', '=', $tahunnyabulanlalu)
        ->where('id_pelanggan', $request->id_pelanggan)
        ->first();
        // dd($scanbulanlalu);
        if(!empty($scanbulanlalu)){
            $tunggakanbulanlalu = ($scanbulanlalu->saldo);
            DB::table('t_meter')->where('id', $scanbulanlalu->id)->update([
                'tunggakan' => $tunggakanbulanlalu,
                'saldo' => 0,
            ]);
        }

        $add = DB::table('t_meter')
        ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
        ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
        ->get();

        $dataclass = DB::table('m_class')
        ->where('id_class', $request->input('id_class'))
        ->first();

        $meterbulanlalu = T_Meter::select('*')
        ->where('id_pelanggan', $request->id_pelanggan)
        ->whereMonth('tgl_scan', '=', $bulanlalu)
        ->whereYear('tgl_scan', '=', $tahunnyabulanlalu)
        ->first();

        if(empty($meterbulanlalu)){
            $meterbulanlalu = 0;
        }else{
            $meterbulanlalu = $meterbulanlalu->stand_meter_bulan_ini;
        }

        // dd($meterbulanlalu);

        // $isi_tunggakan = T_Meter::select('tunggakan')
        // ->where('id_pelanggan', $request->id_pelanggan)
        // ->first();

        // dd($isi_tunggakan);
        $add = new T_Meter;
        $add->id = $request->input('id');
        $add->id_pelanggan = $request->input('id_pelanggan');
        $add->id_class = $request->input('id_class');
        $add->kode_pelanggan = $request->input('kode_pelanggan');
        $add->stand_meter_bulan_lalu = ($meterbulanlalu);
        // $add->stand_meter_bulan_lalu = $request->input('stand_meter_bulan_lalu');
        $add->stand_meter_bulan_ini = $request->input('stand_meter_bulan_ini');
        $add->pemakaian = (intval($request->input('stand_meter_bulan_ini')) - $meterbulanlalu);
        $add->tagihan = ($add->pemakaian * $dataclass->harga_class);
        // $add->tunggakan = $request->input('tunggakan');
        $add->tunggakan = $tunggakanbulanlalu;
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
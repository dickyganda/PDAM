<?php

namespace App\Http\Controllers;

use App\Models\M_Class;
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

    $datapelanggan = DB::table('t_meter')
    ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
    ->select('m_pelanggan.id_pelanggan', 'm_pelanggan.kode_pelanggan', 'm_pelanggan.nama', 'stand_meter_bulan_lalu', 'stand_meter_bulan_ini')
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

        // $dataclass = DB::table('m_class')
        // ->where('id_class', $request->input('id_class'))
        // ->first();

        $datameterbulanlalu = T_Meter::select('*')
        ->where('id_pelanggan', $request->id_pelanggan)
        ->whereMonth('tgl_scan', '=', $bulanlalu)
        ->whereYear('tgl_scan', '=', $tahunnyabulanlalu)
        ->first();
        // dd($meterbulanlalu);

        if(empty($datameterbulanlalu)){
            $meterbulanlalu = 0;
            $sisa_bayar_bulanlalu = 0;
        }else{
            $meterbulanlalu = $datameterbulanlalu->stand_meter_bulan_ini;
            $sisa_bayar_bulanlalu = $datameterbulanlalu->sisa_bayar;
        }
        

        // dd($meterbulanlalu);

        // dd($isi_tunggakan);
        $add = new T_Meter;
        $add->id = $request->input('id');
        $add->id_pelanggan = $request->input('id_pelanggan');
        // $add->id_class = $request->input('id_class');
        $add->kode_pelanggan = $request->input('kode_pelanggan');
        $add->stand_meter_bulan_lalu = ($meterbulanlalu);
        // $add->stand_meter_bulan_lalu = $request->input('stand_meter_bulan_lalu');
        $add->stand_meter_bulan_ini = $request->input('stand_meter_bulan_ini');
        //hitung pemakaian
$pemakaian = (intval($request->input('stand_meter_bulan_ini')) - $meterbulanlalu);
$add->pemakaian = $pemakaian;

//hitung tagihan
$class_bawah = M_Class::select('harga_class')
->where('keterangan', '=', '<=10')
->first();
$class_bawah = $class_bawah->harga_class;
// dd($class_bawah);

$class_atas = M_Class::select('harga_class')
->where('keterangan', '=', '>10')
->first();
$class_atas = $class_atas->harga_class;
// dd($class_atas);

$batas_class = 10;
$tagihan = 0;

if($pemakaian <= $batas_class){
    $tagihan = $pemakaian * $class_bawah;
}
else{
    $tagihan = (10 * $class_bawah) + (($pemakaian-10) * $class_atas);
}

$add->tagihan = $tagihan;
        // $add->pemakaian = (intval($request->input('stand_meter_bulan_ini')) - $meterbulanlalu);
        // $add->tagihan = ($add->pemakaian * $dataclass->harga_class);
        // $add->tunggakan = $request->input('tunggakan');
        $add->tunggakan = $tunggakanbulanlalu;
        $add->sisa_bayar = $sisa_bayar_bulanlalu;
        if($request->hasFile("link_image")){
            $img = $request -> link_image;
            $img_name = time().'-'.$img->getClientOriginalName();
            Image::make($img)->save(storage_path("/app/public/".$img_name));
            $add->link_image = $img_name;
        }

        $add->tgl_scan = Date('Y-m-d');
        $add->save();
        // dd($add);
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Meter;

class ApiController extends Controller
{
    public function insertmeter(Request $request){

        $add = DB::table('t_meter')
        ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_meter.id_pelanggan')
        ->join('m_class', 'm_class.id_class', '=', 't_meter.id_class')
        ->join('m_harga', 'm_harga.id_harga', '=', 't_meter.id_harga')
        ->get();

        $add = new T_Meter;
        $add->id = $request->input('id');
        $add->id_pelanggan = $request->input('id_pelanggan');
        $add->id_harga = $request->input('id_harga');
        $add->id_class = $request->input('id_class');
        $add->kode_pelanggan = $request->input('kode_pelanggan');
        $add->stand_meter_bulan_lalu = $request->input('stand_meter_bulan_lalu');
        $add->stand_meter_bulan_ini = $request->input('stand_meter_bulan_ini');
        $add->pemakaian = ($request->input('stand_meter_bulan_ini') - $request->input('stand_meter_bulan_lalu'));
        $add->tagihan = ($request->input('pemakaian') * $request->input('harga'));
        $add->link_image = $request->input('link_image');
        $add->tgl_scan = Date('Y-m-d');
        $add->save();
        return response([
            'status' => 'Ok',
            'message' => 'Data telah ditambahkan',
            'data' => $add
        ]);

    }

    // public function loginmobile(Request $request){
    //     $add = new T_Meter;
    //     $add->id = $request->input('id');
    //     $add->id_pelanggan = $request->input('id_pelanggan');
    //     $add->id_harga = $request->input('id_harga');
    //     $add->id_class = $request->input('id_class');
    //     $add->kode_pelanggan = $request->input('kode_pelanggan');
    //     $add->stand_meter_bulan_lalu = $request->input('stand_meter_bulan_lalu');
    //     $add->stand_meter_bulan_ini = $request->input('stand_meter_bulan_ini');
    //     $add->pemakaian = $request->input('pemakaian');
    //     $add->tagihan = $request->input('tagihan');
    //     $add->save();
    //     return response([
    //         'status' => 'Ok',
    //         'message' => 'Data telah ditambahkan',
    //         'data' => $add
    //     ]);

    // }
 
    }
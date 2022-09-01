<?php

namespace App\Imports;

use App\Models\T_Meter;
use Maatwebsite\Excel\Concerns\ToModel;

class T_Meter_Import implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new T_Meter([
            //
            'id_pelanggan' => $row[1],
            'id_class' => $row[2],
            'kode_pelanggan' => $row[3],
            'stand_meter_bulan_lalu' => $row[4],
            'stand_meter_bulan_ini' => $row[5],
            'pemakaian' => $row[6],
            'tagihan' => $row[7],
            'biaya_admin' => $row[8],
            'biaya_perawatan' => $row[9],
            'tunggakan' => $row[10],
            'saldo' => $row[11],
            'pembayaran' => $row[12],
            'sisa_bayar' => $row[13],
            'link_image' => $row[14],
            'status' => $row[15],
            'tgl_scan' => $row[16],
            'otorisasi' => $row[17],
        ]);
    }
}

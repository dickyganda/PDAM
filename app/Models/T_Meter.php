<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class T_Meter extends Model
{
    // use LogsActivity;

    protected $table = 't_meter';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id_pelanggan', 'id_class', 'kode_pelanggan', 'stand_meter_bulan_lalu', 'stand_meter_bulan_ini', 'pemakaian', 'tagihan', 'biaya_admin', 'biaya_perawatan', 'tunggakan', 'saldo', 'pembayaran', 'sisa_bayar', 'link_image', 'status', 'tgl_scan', 'otorisasi'];
    // protected static $logName = 't_meter';
    // protected static $logFillable = true;
}

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
    // protected static $logName = 't_meter';
    // protected static $logFillable = true;
}

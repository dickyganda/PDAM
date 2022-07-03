<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_Sessions extends Model
{
    protected $table = 't_sessions';
    public $timestamps = false;
    protected $primaryKey = 'id';
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DatamasteruserlevelController extends Controller
{
    
function Index(){

    $datauserlevel = DB::table('m_user_level')->get();
 
    	return view('/datamasteruserlevel/index', ['datauserlevel' => $datauserlevel]);
    }

}
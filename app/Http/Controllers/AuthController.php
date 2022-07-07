<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;

use Redirect; //untuk redirect


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\M_User;
use App\Models\M_User_Level;


class AuthController extends Controller
{
    public function login()
    {
    	return view('/autentikasi/login')->with('sukses','Anda Berhasil Login');
    }

    public function postlogin(Request $request)
    {
      // echo "$request->email.$request->password "; die;
    	if(Auth::attempt($request->only('email','password'))){
            // $akun = DB::table('users')->where('email', $request->email)->first();
            $akun = DB::table('m_user')
            ->join('m_user_level', 'm_user_level.id_level', '=', 'm_user.id_level')
            ->where('email', $request->email)
            ->first();
            //dd($akun);
            if($akun->nama_level =='Administrator'){
                Auth::guard('Administrator')->LoginUsingId($akun->id);
                return redirect('/dashboard/index')->with('sukses','Anda Berhasil Login');
            } else if($akun->nama_level =='Admin'){
                Auth::guard('Admin')->LoginUsingId($akun->id);
                return redirect('/dashboard/index')->with('sukses','Anda Berhasil Login');
            }
    	}
    	return redirect('/autentikasi/login')->with('error','Akun Belum Terdaftar');
    }

    public function logout()
    {
        if(Auth::guard('Administrator')->check()){
            Auth::guard('Administrator')->logout();
        } else if(Auth::guard('Admin')->check()){
            Auth::guard('Admin')->logout();
        }
    	return redirect('autentikasi/login')->with('sukses','Anda Telah Logout');
    }


}
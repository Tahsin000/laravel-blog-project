<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index (){
        return view('Backend.admin-login');
    }

    public function onLogout (Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
    
    public function onLogin (Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $countValue = Admin::where('username', '=', $username)->where('password', '=', $password)->count();
        if($countValue == 1){
            $request->session()->put('user', $username);
            return 1;
        } else {
            return 0;
        }
    }
}

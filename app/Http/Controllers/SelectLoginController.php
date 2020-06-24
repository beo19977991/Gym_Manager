<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelectLoginController extends Controller
{
    public function getSelectLogin()
    {
        return view('layouts.select_option');
    }
    public function postSelectLogin(Request $request)
    {
        if($request->select_login == 1)
        {
            return redirect()->route('login');
        }
        else if($request->select_login == 2)
        {
            return redirect()->route('login_trainer');
        }
        else if($request->select_login == 3)
        {
            return redirect()->route('login_staff');
        }
        else{
            return redirect()->route('login_admin');
        }
    }
}

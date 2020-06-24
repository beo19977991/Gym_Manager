<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('users.login');
    }
    public function postLogin(Request $request)
    {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email bạn nhập vào chưa đúng',
            'password' => 'Bạn chưa nhập mật khẩu'
        ]);
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        if(Auth::attempt($credentials))
        {
            $request->session()->put('user','login_success');
            return redirect('home');
        }
        else{
            return view('users.login');
        }
    }
    public function getLogout(Request $request)
    {
        $request->session()->forget('key');
        Auth::logout();
        return redirect('home');
    }
}

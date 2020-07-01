<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function getLogin()
    {
        return view('staff.login');
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
        if(Auth::guard('staff')->attempt($credentials) && Auth::guard('staff')->user()->role == 1)
        {
            $request->session()->put('staff','login_success');
            return redirect()->route('page-home');
        }
        else{
            return view('staff.login');
        }
    }
    public function getRegister()
    {
        return view('staff.register');
    }
    public function postRegister(Request $request)
    {
        $this->validate($request,[
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:16',
            'repeat_password' => 'required|same:password',
            'age' => 'required|integer',
            'address' => 'required',
        ],[
            'full_name.required' => 'Bạn chưa nhập họ tên',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'email bạn nhập chưa đúng',
            'email.unique' => 'email đã được sử dụng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải nhiều hơn 8 ký tự',
            'password.max' => 'Mật khẩu phải ít hơn 16 ký tự',
            'repeat_password.required' => 'Bạn chưa nhập lại mật khẩu',
            'repeat_password.same' => 'Mật khẩu nhập lại chưa đúng',
            'age.required' => 'Bạn chưa nhập tuổi',
            'age.integer' => 'Tuổi nhập vào phải là số',
            'address.required' => 'Bạn chưa nhập địa chỉ',
        ]);
        
        $staff = new Staff;
        $staff->full_name = $request->full_name;
        $staff->email = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->age = $request->age;
        $staff->address = $request->address;
        $staff->gender = $request->gender;
        if($request->hasFile('photo'))
        {
            $file=$request->file('photo');
            $extension= $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jepg')
            {
                return redirect()->route('register_staff')->with('error','Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4)."_".$name;
            while(file_exists("upload/staff/photo".$photo))
            {
                $photo = Str::random(4)."_".$name;
            }
            $file->move("upload/staff/photo",$photo);
            $staff->photo = $photo;
        }
        else
        {
            $staff->photo="default.png";
        }
        $staff->role = 1;
        $staff->save();

        return redirect()->route('login_staff');
    }
    public function getLogout(Request $request)
    {
        $request->session()->forget('key');
        Auth::guard('staff')->logout();
        return redirect()->route('page-home');
    }
}

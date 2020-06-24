<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('users.register');
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
        
        $user = new User;
        $user->course_id = 0;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->age = $request->age;
        $user->address = $request->address;
        $user->gender = $request->gender;
        if($request->hasFile('photo'))
        {
            $file=$request->file('photo');
            $extension= $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jepg')
            {
                return redirect('register')->with('error','Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4)."_".$name;
            while(file_exists("upload/user/photo".$photo))
            {
                $photo = Str::random(4)."_".$name;
            }
            $file->move("upload/user/photo",$photo);
            $user->photo = $photo;
        }
        else
        {
            $user->photo="default.png";
        }
        $user->active = 1;
        $user->status = 0;
        $user->save();

        return redirect('login');
    }
}

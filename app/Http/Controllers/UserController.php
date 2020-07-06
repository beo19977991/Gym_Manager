<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Course;
use App\HistoryUser;
use App\Lession;

class UserController extends Controller
{
    public function getCourseRegister($id)
    {
        $user_login_id = Auth::user()->id;
        $user = User::find($user_login_id);
        $user->course_id = $id;
        $user->save();
        $course = Course::find($id);
        $number_member = $course->number_member;
        $course->number_member = $number_member + 1;
        $course->save();
        $history_user = new HistoryUser;
        $history_user->user_id = $user_login_id;
        $history_user->course_id = $id;
        $history_user->status = 1;
        $history_user->save();
        return redirect('page/course/detail/'.$id);
    }
    public function getCancelRegisterCourse($id)
    {
        $user_login_id = Auth::user()->id;
        $user = User::find($user_login_id);
        $user->course_id = 0;
        $user->save();
        $course = Course::find($id);
        $number_member = $course->number_member;
        $course->number_member = $number_member - 1;
        $course->save();
        $history_user = new HistoryUser;
        $history_user->user_id = $user_login_id;
        $history_user->course_id = $id;
        $history_user->status = 0;
        $history_user->save();
        return redirect('page/course/detail/'.$id);
    }

    public function getUserProfile($id)
    {
        $histories = HistoryUser::where('user_id','=',$id)
                                ->orderBy('created_at','DESC')
                                ->get();
        $user = User::find($id);
        $course_id = $user->course_id;
        $lessions = Lession::where('course_id','=',$course_id)->get();
        return view('users.profile',['user'=>$user,'lessions'=>$lessions,'histories'=>$histories]);
    }
    public function postUserProfile($id,Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'age' => 'required|integer',
            'address' => 'required',
        ], [
            'full_name.required' => 'Bạn chưa nhập họ tên',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'email bạn nhập chưa đúng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'age.required' => 'Bạn chưa nhập tuổi',
            'age.integer' => 'Tuổi nhập vào phải là số',
            'address.required' => 'Bạn chưa nhập địa chỉ',
        ]);
        $user = User::find($id);
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->age = $request->age;
        $user->address = $request->address;
        $user->gender = $request->gender;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('get-user-profile',['id'=>$id])->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/user/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/user/photo", $photo);
            unlink("upload/user/photo/" . $user->photo);
            $user->photo = $photo;
        }
        $user->save();
        return redirect()->route('get-user-profile',['id'=>$id]);
    }
}

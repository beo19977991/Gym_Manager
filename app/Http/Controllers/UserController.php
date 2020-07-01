<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function getCourseRegister($id)
    {
        $user_login_id = Auth::user()->id;
        $user = User::find($user_login_id);
        $user->course_id = $id;
        $user->save();
        return redirect('page/course/detail/'.$id);
    }
    public function getCancelRegisterCourse($id)
    {
        $user_login_id = Auth::user()->id;
        $user = User::find($user_login_id);
        $user->course_id = 0;
        $user->save();
        return redirect('page/course/detail/'.$id);
    }
}

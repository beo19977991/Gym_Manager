<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Trainer;
use App\Course;
use App\Exercise;
use App\TrainerPost;
use App\CourseType;
use App\Post;

class TrainerController extends Controller
{
    public function getLogin()
    {
        return view('trainer.login');
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
        if(Auth::guard('trainer')->attempt($credentials))
        {
            $request->session()->put('trainer','login_success');
            return redirect()->route('page-home');
        }
        else{
            return view('trainer.login');
        }
    }
    public function getRegister()
    {
        return view('trainer.register');
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
        
        $trainer = new Trainer;
        $trainer->course_type_id = 0;
        $trainer->full_name = $request->full_name;
        $trainer->email = $request->email;
        $trainer->password = bcrypt($request->password);
        $trainer->age = $request->age;
        $trainer->address = $request->address;
        $trainer->gender = $request->gender;
        if($request->hasFile('photo'))
        {
            $file=$request->file('photo');
            $extension= $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jepg')
            {
                return redirect()->route('register_trainer')->with('error','Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4)."_".$name;
            while(file_exists("upload/trainer/photo".$photo))
            {
                $photo = Str::random(4)."_".$name;
            }
            $file->move("upload/trainer/photo",$photo);
            $trainer->photo = $photo;
        }
        else
        {
            $trainer->photo="default.png";
        }
        $trainer->description ="";
        $trainer->save();

        return redirect()->route('login_trainer');
    }
    public function getLogout(Request $request)
    {
        $request->session()->forget('key');
        Auth::guard('trainer')->logout();
        return redirect()->route('page-home');
    }
    public function getTrainerDetail($id)
    {
        $trainer_posts = TrainerPost::where('trainer_id','=',$id)
                                    ->orderBy('created_at','DESC')
                                    ->get();
        $trainer_others = Trainer::where('id','!=',$id)->get();
        $exercise_trainers = Exercise::where('trainer_id','=',$id)
                                        ->orderBy('created_at','DESC')            
                                        ->get();
        $course_trainers = Course::where('trainer_id','=',$id)->get();
        $trainer = Trainer::find($id);
        return view('trainer.trainer_detail',['trainer'=>$trainer,'course_trainers'=>$course_trainers,'exercise_trainers'=>$exercise_trainers,'trainer_others'=>$trainer_others,'trainer_posts'=>$trainer_posts]);
    }
    public function getTrainerPostDetail($id)
    {
        $posts = Post::orderBy('created_at','DESC')->take(5)->get();
        $course_types = CourseType::all();
        $trainer_post = TrainerPost::find($id);
        return view('trainer.trainer_post_detail',['trainer_post'=>$trainer_post,'course_types'=>$course_types,'posts'=>$posts]);
    }
    public function getHome()
    {

    }
    public function getTrainerProfile($id)
    {

    }
    public function postTrainerProfile($id, Request $request)
    {
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DateTime;

use App\Staff;
use App\User;
use App\Course;
use App\CourseType;
use App\Trainer;
use App\Exercise;
use App\ExerciseType;
use App\Lession;
use App\LessionDetail;

class AdminController extends Controller
{
    public function getHome()
    {
        return view('admin.index');
    }
    // Admin Login- Logout
    public function getLogin()
    {
        return view('admin.layouts.login');
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
        if(Auth::guard('staff')->attempt($credentials))
        {
            $request->session()->put('admin','login_success');
            return redirect()->route('admin-home');
        }
        else{
            return view('admin.layouts.login');
        }
    }
    public function getLogout(Request $request)
    {
        $request->session()->forget('key');
        Auth::guard('staff')->logout();
        return redirect('home');
    }
    // End Admin Login -Logout

    // Start Manager User
    public function getListUser()
    {
        $users = User::orderBy('created_at','DESC')->get();
        return view('admin.users.list',['users'=>$users]);
    }
    public function getAddUser()
    {
        $courses = Course::all();
        return view('admin.users.add',['courses'=>$courses]);
    }
    public function postAddUser(Request $request)
    {
        $this->validate($request,[
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:16',
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
            'age.required' => 'Bạn chưa nhập tuổi',
            'age.integer' => 'Tuổi nhập vào phải là số',
            'address.required' => 'Bạn chưa nhập địa chỉ',
        ]);
        
        $user = new User;
        $user->course_id = $request->course;
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
                return redirect()->route('admin-add-user')->with('error','Bạn phải chọn file có dạng jpg, png, jepg');
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
        return redirect()->route('admin-list-user')->with('message','Thêm Khách Hàng thành công');
    }
    public function getBlockUser($user_id)
    {
        $user = User::find($user_id);
        $user->active = !($user->active);
        $user->save();
    }
    public function getEditUser($id)
    {
        $courses = Course::all();
        $user = User::find($id);
        return view('admin.users.edit',['user'=>$user,'courses'=>$courses]);
    }

    public function postEditUser($id, Request $request)
    {
        $this->validate($request,[
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:16',
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
            'age.required' => 'Bạn chưa nhập tuổi',
            'age.integer' => 'Tuổi nhập vào phải là số',
            'address.required' => 'Bạn chưa nhập địa chỉ',
        ]);
        $user = User::find($id);
        $user->course_id = $request->course;
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
                return redirect()->route('admin-add-user')->with('error','Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4)."_".$name;
            while(file_exists("upload/user/photo".$photo))
            {
                $photo = Str::random(4)."_".$name;
            }
            $file->move("upload/user/photo",$photo);
            unlink("upload/user/photo".$user->photo);
            $user->photo = $photo;
        }
        $user->active = 1;
        $user->status = 0;
        $user->save();
        return redirect()->route('admin-list-user')->with('message','Thêm Khách Hàng thành công');
    }
    public function getDeleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin-list-user')->with('message','Xóa Khách Hàng Thành Công');
    }

    // End Manager User

    // Start Manager Course Type
    public function getListCourseType()
    {
        $course_types = CourseType::all();
        return view('admin.course_types.list',['course_types'=>$course_types]);
        
    }
    public function getAddCourseType()
    {
        return view('admin.course_types.add');
    }

    public function postAddCourseType(Request $request)
    {
        $this->validate($request,[
            'course_type_name' => 'required|unique:course_types,course_type_name',
            'description' => 'required',
        ],[
            'course_type_name.required' => 'Bạn chưa nhập tên loại khóa tập',
            'course_type_name.unique' => 'Tên Loại Khóa tập bạn nhập vào đã được sử dụng',
            'description.required' => 'Bạn chưa nhập vào mô tả loại khóa tập'
        ]);
        $course_type = new CourseType;
        $course_type->course_type_name = $request->course_type_name;
        $course_type->description =$request->description;
        $course_type->save();
        return redirect()->route('admin-list-course-type')->with('message','Thêm lọai khóa tập thành công');
    }
    public function getEditCourseType($id)
    {
        $course_type = CourseType::find($id);
        return view('admin.course_types.edit',['course_type'=>$course_type]);
    }
    public function postEditCourseType($id, Request $request)
    {
        $this->validate($request,[
            'course_type_name' => 'required',
            'description' => 'required',
        ],[
            'course_type_name.required' => 'Bạn chưa nhập tên loại khóa tập',
            'description.required' => 'Bạn chưa nhập vào mô tả loại khóa tập'
        ]);
        $course_type = CourseType::find($id);
        $course_type->course_type_name = $request->course_type_name;
        $course_type->description =$request->description;
        $course_type->save();
        return redirect()->route('admin-list-course-type')->with('message','Thay đổi loại khóa tập thành công');
    }
    public function getDeleteCourseType($id)
    {
        $course_type = CourseType::find($id);
        $course_type->delete();
        return redirect()->route('admin-list-course-type')->with('message','Xóa loại khóa tập thành công');
    }
    // End Manager Course Type
    // start Course
    public function getListCourse()
    {
        $courses = Course::orderBy('created_at','DESC')->get();
        return view('admin.courses.list',['courses'=>$courses]);
    }
    public function getAddCourse()
    {
        $course_types = CourseType::all();
        $trainers = Trainer::all();
        return view('admin.courses.add',['course_types'=>$course_types,'trainers'=>$trainers]);
    }
    public function getTrainer($course_id)
    {
        $trainers = Trainer::where('course_type_id',$course_id)->get();
        foreach($trainers as $trainer)
        {
            echo "<option value = '" .$trainer->id."'>".$trainer->full_name."</option>";
        }
    }
    public function postAddCourse(Request $request)
    {
        $this->validate($request,[
            'course_name' =>'required|unique:courses,course_name',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ],[
            'course_name.required' => 'Bạn chưa nhập tên khóa tập',
            'course_name.unique' => 'Tên Khóa Tập đã được dùng',
            'price.required' => 'Bạn chưa nhập giá khóa tập',
            'price.numeric' => 'Giá Nhập vào phải là số',
            'discount.required' => 'Bạn chưa nhập giảm giá',
            'discount.numeric' => 'Giảm giá nhập vào phải là số',
            'start_time.required' => 'Bạn chưa chọn ngày bắt đầu khóa tập',
            'start_time.date' => 'Bạn nhập vào không phải ngày',
            'end_time.required' => 'Bạn chưa nhập ngày kết thúc khóa tập',
            'end_time.date' => 'Bạn nhập vào không phải ngày',
            'end_time.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
        ]);
        $course = new Course;
        $course->course_type_id = $request->course_type;
        $course->trainer_id = $request->trainer;
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->start_time = $request->start_time;
        $course->end_time = $request->end_time;
        if($request->hasFile('photo'))
        {
            $file=$request->file('photo');
            $extension= $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jepg')
            {
                return redirect()->route('admin-add-course')->with('error','Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4)."_".$name;
            while(file_exists("upload/course/photo".$photo))
            {
                $photo = Str::random(4)."_".$name;
            }
            $file->move("upload/course/photo",$photo);
            $course->photo = $photo;
        }
        else
        {
            $course->photo="default.jpg";
        }
        $course->save();
        return redirect()->route('admin-list-course')->with('message','Thêm Khóa Tập Thành Công');
    }
    public function getEditCourse($id)
    {
        $course_types = CourseType::all();
        $trainers = Trainer::all();
        $course = Course::find($id);
        return view ('admin.courses.edit',['course'=>$course,'course_types'=>$course_types,'trainers'=>$trainers]);
    }
    public function postEditCourse(Request $request, $id)
    {
        $this->validate($request,[
            'course_name' =>'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ],[
            'course_name.required' => 'Bạn chưa nhập tên khóa tập',
            'price.required' => 'Bạn chưa nhập giá khóa tập',
            'price.numeric' => 'Giá Nhập vào phải là số',
            'discount.required' => 'Bạn chưa nhập giảm giá',
            'discount.numeric' => 'Giảm giá nhập vào phải là số',
            'start_time.required' => 'Bạn chưa chọn ngày bắt đầu khóa tập',
            'start_time.date' => 'Bạn nhập vào không phải ngày',
            'end_time.required' => 'Bạn chưa nhập ngày kết thúc khóa tập',
            'end_time.date' => 'Bạn nhập vào không phải ngày',
            'end_time.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
        ]);
        $course = Course::find($id);
        $course->course_type_id = $request->course_type;
        $course->trainer_id = $request->trainer;
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->start_time = $request->start_time;
        $course->end_time = $request->end_time;
        if($request->hasFile('photo'))
        {
            $file=$request->file('photo');
            $extension= $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jepg')
            {
                return redirect()->route('admin-add-course')->with('error','Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4)."_".$name;
            while(file_exists("upload/course/photo".$photo))
            {
                $photo = Str::random(4)."_".$name;
            }
            $file->move("upload/course/photo",$photo);
            unlink("upload/course/photo".$course->photo);
            $course->photo = $photo;
        }
        $course->save();
        return redirect()->route('admin-list-course')->with('message','Sửa Khóa Tập Thành Công');
    }
    public function getDeleteCourse($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('admin-list-course')->with('message','Xóa Khóa Tập Thành Công');
    }
    // End Course

    // Start Exercise Type
    public function getListExerciseType()
    {
        $exercise_types = ExerciseType::all();
        return view('admin.exercise_types.list',['exercise_types'=>$exercise_types]);
        
    }
    public function getAddExerciseType()
    {
        return view('admin.exercise_types.add');
    }

    public function postAddExerciseType(Request $request)
    {
        $this->validate($request,[
            'exercise_type_name' => 'required|unique:exercise_types,exercise_type_name',
        ],[
            'exercise_type_name.required' => 'Bạn chưa nhập tên loại bài tập',
            'exercise_type_name.unique' => 'Tên Loại Bài tập bạn nhập vào đã được sử dụng',
        ]);
        $exercise_type = new ExerciseType;
        $exercise_type->exercise_type_name = $request->exercise_type_name;
        $exercise_type->save();
        return redirect()->route('admin-list-exercise-type')->with('message','Thêm loại bài tập thành công');
    }
    public function getEditExerciseType($id)
    {
        $exercise_type = ExerciseType::find($id);
        return view('admin.exercise_types.edit',['exercise_type'=>$exercise_type]);
    }
    public function postEditExerciseType($id, Request $request)
    {
        $this->validate($request,[
            'exercise_type_name' => 'required',
        ],[
            'exercise_type_name.required' => 'Bạn chưa nhập tên loại bài tập',
        ]);
        $exercise_type = ExerciseType::find($id);
        $exercise_type->exercise_type_name = $request->exercise_type_name;
        $exercise_type->save();
        return redirect()->route('admin-list-exercise-type')->with('message','Thay đổi loại bài tập thành công');
    }
    public function getDeleteExerciseType($id)
    {
        $exercise_type = ExerciseType::find($id);
        $exercise_type->delete();
        return redirect()->route('admin-list-exercise-type')->with('message','Xóa loại bài tập thành công');
    }
    // End Exercise Type

    // Start Exercise
    public function getListExercise()
    {
        $exercises = Exercise::all();
        return view('admin.exercises.list',['exercises'=>$exercises]);
        
    }
    public function getAddExercise()
    {
        $trainers = Trainer::all();
        $exercise_types = ExerciseType::all();
        return view('admin.exercises.add',['exercise_types'=>$exercise_types,'trainers'=>$trainers]);
    }

    public function postAddExercise(Request $request)
    {
        $this->validate($request,[
            'exercise_name' => 'required|unique:exercises,exercise_name',
            'description' => 'required',
        ],[
            'exercise_name.required' => 'Bạn chưa nhập tên bài tập',
            'exercise_name.unique' => 'Tên Bài tập bạn nhập vào đã được sử dụng',
            'description.required' => 'Bạn chưa nhập vào mô tả bài tập'
        ]);
        $exercise = new Exercise;
        $exercise->exercise_type_id = $request->exercise_type;
        $exercise->exercise_name = $request->exercise_name;
        $exercise->description = $request->description;
        $exercise->trainer_id = $request->trainer;
        if($request->hasFile('video'))
        {
            $file=$request->file('video');
            $extension= $file->getClientOriginalExtension();
            if($extension != 'mp4' && $extension != 'wmv' && $extension != 'mov' && $extension != 'flv' && $extension != 'avi')
            {
                return redirect()->redirect('admin-add-exercise')->with('error','Chỉ hỗ trợ các loại file mp4, wmv, mov, flv, avi');
            }
            $name = $file->getClientOriginalName();
            $video = Str::random(4)."_".$name;
            while(file_exists("upload/exercise/video".$video))
            {
                $video = Str::random(4)."_".$name;
            }
            $file->move("upload/exercise/video",$video);
            $exercise->video=$video;
        }
        else
        {
            $exercise->video="";
        }
        $exercise->save();
        return redirect()->route('admin-list-exercise')->with('message','Thêm bài tập thành công');
    }
    public function getEditExercise($id)
    {
        $trainers = Trainer::all();
        $exercise_types = ExerciseType::all();
        $exercise = Exercise::find($id);
        return view('admin.exercises.edit',['exercise'=>$exercise,'exercise_types'=>$exercise_types,'trainers'=>$trainers]);
    }
    public function postEditExercise($id, Request $request)
    {
        $this->validate($request,[
            'exercise_name' => 'required',
            'description' => 'required',
        ],[
            'exercise_name.required' => 'Bạn chưa nhập tên bài tập',
            'description.required' => 'Bạn chưa nhập vào mô tả bài tập'
        ]);
        $exercise = Exercise::find($id);
        $exercise->exercise_type_id = $request->exercise_type;
        $exercise->exercise_name = $request->exercise_name;
        $exercise->description = $request->description;
        $exercise->trainer_id = $request->trainer;
        if($request->hasFile('video'))
        {
            $file=$request->file('video');
            $extension= $file->getClientOriginalExtension();
            if($extension != 'mp4' && $extension != 'wmv' && $extension != 'mov' && $extension != 'flv' && $extension != 'avi')
            {
                return redirect()->redirect('admin-add-exercise')->with('error','Chỉ hỗ trợ các loại file mp4, wmv, mov, flv, avi');
            }
            $name = $file->getClientOriginalName();
            $video = Str::random(4)."_".$name;
            while(file_exists("upload/exercise/video".$video))
            {
                $video = Str::random(4)."_".$name;
            }
            $file->move("upload/exercise/video",$video);
            unlink("upload/exercise/photo".$exercise->photo);
            $exercise->video=$video;
        }
        $exercise->save();
        return redirect()->route('admin-list-exercise')->with('message','Sửa bài tập thành công');
    }
    public function getDeleteExercise($id)
    {
        $exercise = ExerciseType::find($id);
        $exercise->delete();
        return redirect()->route('admin-list-exercise')->with('message','Xóa bài tập thành công');
    }
    // End Exercise
    // Start Schedule
    public function getCreateCalendar()
    {
        $courses = Course::all();
        return view('admin.schedules.calendar',['courses'=>$courses]);
    }
    public function postCreateCalendar(Request $request)
    {
        $lession = new Lession;
        $lession->course_id = $request->course_id;
        $lession->start_time = new DateTime($request->start_time);
        $lession->end_time = new DateTime($request->end_time);
        $lession->save();
        return 1;
    }
    // End Schedule
}

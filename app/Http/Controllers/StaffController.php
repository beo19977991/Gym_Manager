<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Post;
use App\CourseType;
use App\Course;
use App\User;
use App\Trainer;
use App\Lession;
use App\Product;
use App\ProductType;
use App\HistoryUser;
use DateTime;
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
    public function getPostDetail($id)
    {
        $course_types = CourseType::all();
        $post = Post::find($id);
        $news_posts = Post::orderBy('created_at','DESC')->get();
        return view('staff.post_detail',['post'=>$post,'news_posts'=>$news_posts,'course_types'=>$course_types]);
    }
    // Manager==============================================
    public function getHome()
    {
        return view('staff.index');
    }
    
    public function getStaffProfile($id)
    {
        $staff = Staff::find($id);
        return view('staff.profile',['staff'=>$staff]);
    }
    public function postStaffProfile($id, Request $request)
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
        $staff = Staff::find($id);
        $staff->full_name = $request->full_name;
        $staff->email = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->age = $request->age;
        $staff->address = $request->address;
        $staff->gender = $request->gender;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('get-staff-profile',['id'=>$id])->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/staff/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/staff/photo", $photo);
            if($staff->photo!="default.png"){
                unlink("upload/staff/photo/" . $staff->photo);
            }
            $staff->photo = $photo;
        }
        $staff->save();
        return redirect()->route('get-staff-profile',['id'=>$id]);
    }
    public function getListUser()
    {
        $today = new DateTime;
        $current = $today->format('Y-m-d H:i:s');
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('staff.user.list',['users'=>$users,'current'=>$current]);
    }

    public function getAddUser()
    {
        $courses = Course::where('number_member','<','number')->get();
        return view('staff.user.add', ['courses' => $courses]);
    }
    public function postAddUser(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:16',
            'age' => 'required|integer',
            'address' => 'required',
        ], [
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
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-get-add-user')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/user/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/user/photo", $photo);
            $user->photo = $photo;
        } else {
            $user->photo = "default.png";
        }
        $user->active = 1;
        $user->status = 0;
        $user->save();
        return redirect()->route('staff-get-list-user')->with('message', 'Thêm Khách Hàng thành công');
    }
    public function getEditUser($id)
    {
        $courses = Course::all();
        $user = User::find($id);
        return view('staff.user.edit',['user'=>$user,'courses'=>$courses]);
    }
    public function postEditUser($id, Request $request)
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
        $user->course_id = $request->course;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->age = $request->age;
        $user->address = $request->address;
        $user->gender = $request->gender;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-get-edit-user')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/user/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/user/photo", $photo);
            if($user->photo!="default.png"){
                unlink("upload/user/photo/" . $user->photo);
            }
            $user->photo = $photo;
        }
        $user->active = 1;
        $user->status = $request->status;
         $user->save();
         return redirect()->route('staff-get-list-user')->with('message', 'Sửa Khách Hàng thành công');
    }
    public function getDeleteUser($id)
    {
        $user = User::destroy($id);
        return redirect()->route('staff-get-list-user')->with('message','Xóa Khách Hàng Thành Công');
    }
    public function getBlockUser($user_id)
    {
        $user = User::find($user_id);
        $user->active = !($user->active);
        $user->save();
    }
    public function getAjaxEdit($course_id)
    {
        $course_edit = Course::find($course_id);
        return $course_edit;
    }
    // Manager Trainer ===================================================================
    public function getListTrainer()
    {
        $trainers = Trainer::orderBy('created_at', 'DESC')->get();
        return view('staff.trainer.list', ['trainers' => $trainers]);
    }
    public function getAddTrainer()
    {
        $course_types = CourseType::all();
        return view('staff.trainer.add', ['course_types' => $course_types]);
    }
    public function postAddTrainer(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:trainers,email',
            'password' => 'required|min:8|max:16',
            'age' => 'required|integer',
            'address' => 'required',
            'description' => 'required',
        ], [
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
            'description.required' => 'Bạn chưa nhập mô tả',
        ]);
        $trainer = new Trainer;
        $trainer->course_type_id = $request->course_type;
        $trainer->full_name = $request->full_name;
        $trainer->email = $request->email;
        $trainer->password = bcrypt($request->password);
        $trainer->age = $request->age;
        $trainer->address = $request->address;
        $trainer->gender = $request->gender;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-add-trainer')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/trainer/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/trainer/photo", $photo);
            $trainer->photo = $photo;
        } else {
            $trainer->photo = "default.png";
        }
        $trainer->description = $request->description;
        $trainer->save();
        return redirect()->route('staff-list-trainer')->with('message', 'Thêm huấn luyện viên thành công');
    }
    public function getEditTrainer($id)
    {
        $course_types = CourseType::all();
        $trainer = Trainer::find($id);
        return view('staff.trainer.edit', ['trainer' => $trainer, 'course_types' => $course_types]);
    }
    public function postEditTrainer($id, Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'repeat_password' => 'required|same:password',
            'age' => 'required|integer',
            'address' => 'required',
            'description' => 'required',
        ], [
            'full_name.required' => 'Bạn chưa nhập họ tên',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'email bạn nhập chưa đúng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'repeat_password.required' => 'Bạn chưa nhập lại mật khẩu',
            'repeat_password.same' => 'Nhập lại mật khẩu không đúng',
            'age.required' => 'Bạn chưa nhập tuổi',
            'age.integer' => 'Tuổi nhập vào phải là số',
            'address.required' => 'Bạn chưa nhập địa chỉ',
            'description.required' => 'Bạn chưa nhập mô tả', 
        ]);
        $trainer = Trainer::find($id);
        $trainer->course_type_id = $request->course_type;
        $trainer->full_name = $request->full_name;
        $trainer->email = $request->email;
        $trainer->password = bcrypt($request->password);
        $trainer->age = $request->age;
        $trainer->address = $request->address;
        $trainer->gender = $request->gender;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-edit-trainer')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/trainer/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/trainer/photo", $photo);
            if($trainer->photo!="default.png"){
                unlink("upload/trainer/photo/" . $trainer->photo);
            }
            $trainer->photo = $photo;
        }
        $trainer->description = $request->description;
        $trainer->save();
        return redirect()->route('staff-list-trainer')->with('message', 'Sửa huấn luyện viên thành công');
    }
    public function getDeleteTrainer($id)
    {
        $trainer = Trainer::destroy($id);
        return redirect()->route('staff-list-trainer')->with('message','Xóa Huấn Luyện Viên Thành Công');

    }
    // End Manager Trainer ===============================================================
    // Manager Course Type ===============================================================
    public function getListCourseType()
    {
        $course_types = CourseType::all();
        return view('staff.course_type.list',['course_types'=>$course_types]);
    }
    public function getAddCourseType()
    {
        return view('staff.course_type.add');
    }
    public function postAddCourseType(Request $request)
    {
        $this->validate($request, [
            'course_type_name' => 'required|unique:course_types,course_type_name',
            'description' => 'required',
        ], [
            'course_type_name.required' => 'Bạn chưa nhập tên loại khóa tập',
            'course_type_name.unique' => 'Tên Loại Khóa tập bạn nhập vào đã được sử dụng',
            'description.required' => 'Bạn chưa nhập vào mô tả loại khóa tập',
        ]);
        $course_type = new CourseType;
        $course_type->course_type_name = $request->course_type_name;
        $course_type->description = $request->description;
        $course_type->save();
        return redirect()->route('staff-list-course-type')->with('message', 'Thêm lọai khóa tập thành công');
    }

    public function getEditCourseType($id)
    {
        $course_type = CourseType::find($id);
        return view('staff.course_type.edit', ['course_type' => $course_type]);
    }

    public function postEditCourseType($id, Request $request)
    {
        $this->validate($request, [
            'course_type_name' => 'required',
            'description' => 'required',
        ], [
            'course_type_name.required' => 'Bạn chưa nhập tên loại khóa tập',
            'description.required' => 'Bạn chưa nhập vào mô tả loại khóa tập',
        ]);
        $course_type = CourseType::find($id);
        $course_type->course_type_name = $request->course_type_name;
        $course_type->description = $request->description;
        $course_type->save();
        return redirect()->route('staff-list-course-type')->with('message', 'Thay đổi loại khóa tập thành công');
    }

    public function getDeleteCourseType($id)
    {
        $course_type = CourseType::destroy($id);
        return redirect()->route('staff-list-course-type')->with('message','Xóa Loại Khóa Tập Thành Công');
    }
    // End Course Type ===================================================================
    // Manager Course ====================================================================
    public function getListCourse()
    {
        $today = new DateTime;
        $current = $today->format('Y-m-d H:i:s');
        $courses = Course::orderBy('created_at', 'DESC')->get();
        $users = User::all();
        return view('staff.course.list', ['courses' => $courses,'current'=>$current,'users'=>$users]);
    }
    public function getAddCourse()
    {
        $course_types = CourseType::all();
        $trainers = Trainer::all();
        return view('staff.course.add', ['course_types' => $course_types, 'trainers' => $trainers]);
    }
    public function postAddCourse(Request $request)
    {
        $this->validate($request, [
            'course_name' => 'required|unique:courses,course_name',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'number' => 'required|numeric|max:20',
        ], [
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
            'number.required' => 'Bạn chưa nhập vào số lượng khách hàng',
            'number.numeric' => 'Giá trị nhập vào phải là số',
            'number.max' => 'Số lượng khách hàng tối đa 20 người'
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
        $course->number_member = 0;
        $course->number = $request->number;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-add-course')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/course/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/course/photo", $photo);
            $course->photo = $photo;
        } else {
            $course->photo = "default.jpg";
        }
        $course->save();
        return redirect()->route('staff-list-course')->with('message', 'Thêm Khóa Tập Thành Công');
    }
    public function getEditCourse($id)
    {

        $course_types = CourseType::all();
        $course = Course::find($id);
        $course_type_id = $course->course_type_id;
        $trainers = Trainer::where('course_type_id','=',$course_type_id)->get();
        return view('staff.course.edit', ['course' => $course, 'course_types' => $course_types, 'trainers' => $trainers]);
    }
    public function postEditCourse($id, Request $request)
    {
        $this->validate($request, [
            'course_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'number' => 'required|numeric|max:20',
        ], [
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
            'number.required' => 'Bạn chưa nhập vào số lượng khách hàng',
            'number.numeric' => 'Giá trị nhập vào phải là số',
            'number.max' => 'Số lượng khách hàng tối đa 20 người'
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
        $course->number = $request->number;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-edit-course')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/course/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/course/photo", $photo);
            if($course->photo != "default.jpg"){
                unlink("upload/course/photo/" . $course->photo);
            }
            $course->photo = $photo;
        }
        $course->save();
        return redirect()->route('staff-list-course')->with('message', 'Sửa Khóa Tập Thành Công');
    }
    public function getDeleteCourse($id)
    {
        $course = Course::destroy($id);
        return redirect()->route('staff-list-course')->with('message','Xóa Khóa Tập Thành Công');
    }
    public function getTrainerCourseType($course_type_id)
    {
        $trainers = Trainer::where('course_type_id', $course_type_id)->get();
        foreach ($trainers as $trainer) {
            echo "<option value = '" . $trainer->id . "'>" . $trainer->full_name . "</option>";
        }
    }
    public function getTrainerEditCourse($course_type_id)
    {
        $trainers = Trainer::where('course_type_id', $course_type_id)->get();
        foreach ($trainers as $trainer) {
            echo "<option value = '" . $trainer->id . "'>" . $trainer->full_name . "</option>";
        }
    }
    // End Course ========================================================================
    // Start Post ========================================================================
    public function getListPost()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        return view('staff.post.list', ['posts' => $posts]);
    }
    public function getAddPost()
    {
        return view('staff.post.add');
    }
    public function postAddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'Bạn chưa nhập tên bài viết',
            'body.required' => 'Bạn chưa nhập nội dung bài viết',
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->staff_id = Auth::guard('staff')->user()->id;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-add-post')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/post/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/post/photo", $photo);
            $post->photo = $photo;
        } else {
            $post->photo = "default.jpg";
        }
        $post->save();
        return redirect()->route('staff-list-post')->with('message', 'Thêm bài viết thành công');
    }
    public function getEditPost($id)
    {
        $post = Post::find($id);
        return view('staff.post.edit', ['post' => $post]);
    }
    public function postEditPost($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'Bạn chưa nhập tên bài viết',
            'body.required' => 'Bạn chưa nhập nội dung bài viết',
        ]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->staff_id = Auth::guard('staff')->user()->id;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-edit-post')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/post/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/post/photo", $photo);
            if($post->photo!="default.jpg"){
                unlink("upload/post/photo/" . $post->photo);
            }
            $post->photo = $photo;
        }
        $post->save();
        return redirect()->route('staff-list-post')->with('message', 'Sửa bài viết thành công');
    }
    public function getDeletePost($id)
    {
        $post = Post::destroy($id);
        return redirect()->route('staff-list-post')->with('message', 'Xóa bài viết thành công');
    }
    // End Post ==========================================================================
    // Manager Schedule ==================================================================
    public function getAddSchedule()
    {
        $lessions = Lession::all();
        $courses = Course::all();
        return view('staff.schedule.add_schedule', ['courses' => $courses, 'lessions' => $lessions]);
    }
    public function postAddSchedule(Request $request)
    {
        $lession = new Lession;
        $lession->course_id = $request->course_id;
        $lession->start_time = new DateTime($request->start_time);
        $lession->end_time = new DateTime($request->start_time);
        $lession->save();
        return 1;
    }
    public function postDeleteSchedule($id)
    {
        $lession = Lession::destroy($id);
        return $lession;
    }
    public function checkDateClick($date, $time)
    {
        $courses = Course::where('start_time', '<=', $date)
            ->where('end_time', '>=', $date)
            ->get();
        foreach ($courses as $course) {
            echo "<option value = '" . $course->id . "'>" . $course->course_name . "</option>";
        }
    }
    // End Schedule
    public function getListProductType()
    {
        $product_types = ProductType::orderBy('created_at', 'DESC')->get();
        return view('staff.product_type.list', ['product_types' => $product_types]);
    }
    public function getAddProductType()
    {
        return view('staff.product_type.add');
    }
    public function postAddProductType(Request $request)
    {
        $this->validate($request, [
            'product_type_name' => 'required',
            'discription' => 'required',
        ], [
            'product_type_name.required' => 'Bạn chưa nhập tên loại sản phẩm',
            'discription.required' => 'Bạn chưa nhập mô tả loại sản phẩm',
        ]);
        $product_type = new ProductType;
        $product_type->product_type_name = $request->product_type_name;
        $product_type->discription = $request->discription;
        $product_type->save();
        return redirect()->route('staff-list-product-type')->with('message', 'Thêm Loại sản phẩm thành công');
    }
    public function getEditProductType($id)
    {
        $product_type = ProductType::find($id);
        return view('staff.product_type.edit', ['product_type' => $product_type]);
    }
    public function postEditProductType($id, Request $request)
    {
        $this->validate($request, [
            'product_type_name' => 'required',
            'discription' => 'required',
        ], [
            'product_type_name.required' => 'Bạn chưa nhập tên loại sản phẩm',
            'discription.required' => 'Bạn chưa nhập mô tả loại sản phẩm',
        ]);
        $product_type = ProductType::find($id);
        $product_type->product_type_name = $request->product_type_name;
        $product_type->discription = $request->discription;
        $product_type->save();
        return redirect()->route('staff-list-product-type')->with('message', 'Sửa loại sản phẩm thành công');
    }
    public function getDeleteProductType($id)
    {
        $product_type = ProductType::destroy($id);
        return redirect()->route('staff-list-product-type')->with('message', 'Xóa loại sản phẩm thành công');
    }
    // End Product Type ======================================================================
    // Manager Product
    public function getListProduct()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('staff.product.list',['products'=>$products]);
    }
    public function getAddProduct()
    {
        $product_types = ProductType::all();
        return view('staff.product.add',['product_types'=>$product_types]);
    }
    public function postAddProduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'discription' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ], [
            'product_name.required' => 'Bạn chưa nhập tên loại sản phẩm',
            'discription.required' => 'Bạn chưa nhập mô tả loại sản phẩm',
            'price.required' => 'Bạn chưa nhập giá của sản phẩm',
            'quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
        ]);

        $product = new Product;
        $product->product_type_id = $request->product_type;
        $product->product_name = $request->product_name;
        $product->description = $request->discription;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-add-product')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/product/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/product/photo", $photo);
            $product->photo = $photo;
        } else {
            $product->photo = "default.png";
        }
        $product->save();
        return redirect()->route('staff-list-product')->with('message','Thêm sản phẩm thành công');
    }
    public function getEditProduct($id)
    {
        $product_types = ProductType::all();
        $product = Product::find($id);
        return view('staff.product.edit',['product'=>$product,'product_types'=>$product_types]);
    }
    public function postEditProduct($id, Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'discription' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ], [
            'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
            'discription.required' => 'Bạn chưa nhập mô tả  sản phẩm',
            'price.required' => 'Bạn chưa nhập giá của sản phẩm',
            'quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
        ]);

        $product = Product::find($id);
        $product->product_type_id = $request->product_type;
        $product->product_name = $request->product_name;
        $product->description = $request->discription;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('staff-add-product')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/product/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/product/photo", $photo);
            if($product->photo!="default.png"){
                unlink("upload/product/photo/" . $post->photo);
            }
            $product->photo = $photo;
        }
        $product->save();
        return redirect()->route('staff-list-product')->with('message','Sửa Sản phẩm thành công');
    }
    public function getDeleteProduct($id)
    {
        $product = Product::destroy($id);
        return redirect()->route('staff-list-product')->with('message','Xóa sản phẩm thành công');
    }
    // ============================================================================
    // User Detail ================================================================
    public function getUserDetail($id)
    {
        $histories = HistoryUser::where('user_id','=',$id)
                                ->orderBy('created_at','DESC')
                                ->get();
        $user = User::find($id);
        return view('staff.user.user_detail',['user'=>$user,'histories'=>$histories]);
    }
}

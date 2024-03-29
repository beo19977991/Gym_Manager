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
use App\ExerciseType;
use App\User;
use App\HistoryUser;
use App\Lession;
use DateTime;

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
        return view('trainer.index');
    }
    public function getTrainerProfile($id)
    {
        $today = new DateTime;
        $current = $today->format('Y-m-d H:i:s');
        $trainer = Trainer::find($id);
        $courses = Course::where('trainer_id','=',$id)
                        ->where('end_time','>=',$current)
                        ->orderBy('created_at','DESC')
                        ->get();
        $lessions = [];
        foreach($courses as $course)
        {
            $array = Lession::where('course_id','=',$course->id)->get();
            array_push($lessions,$array);
        }
        return view('trainer.profile',['trainer'=>$trainer,'courses'=>$courses,'lessions'=>$lessions]);
    }
    public function postTrainerProfile($id, Request $request)
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
        $trainer = Trainer::find($id);
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
                return redirect()->route('get-trainer-profile',['id'=>$id])->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/trainer/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/trainer/photo", $photo);
            unlink("upload/trainer/photo/" . $trainer->photo);
            $trainer->photo = $photo;
        }
        $trainer->save();
        return redirect()->route('get-trainer-profile',['id'=>$id]);
    }
    public function getListExerciseType()
    {
        $exercise_types = ExerciseType::all();
        return view('trainer.exercise_type.list', ['exercise_types' => $exercise_types]);
    }
    public function getAddExerciseType()
    {
        $trainer = Auth::guard('trainer')->user();
        $course_type_id = $trainer->course_type_id;
        $course_type = CourseType::find($course_type_id);
        return view('trainer.exercise_type.add', ['course_type' => $course_type]);
    }
    public function postAddExerciseType(Request $request)
    {
        $this->validate($request, [
            'exercise_type_name' => 'required|unique:exercise_types,exercise_type_name',
        ], [
            'exercise_type_name.required' => 'Bạn chưa nhập tên loại bài tập',
            'exercise_type_name.unique' => 'Tên Loại Bài tập bạn nhập vào đã được sử dụng',
        ]);
        $exercise_type = new ExerciseType;
        $exercise_type->course_type_id = $request->course_type;
        $exercise_type->exercise_type_name = $request->exercise_type_name;
        $exercise_type->save();
        return redirect()->route('trainer-list-exercise-type')->with('message', 'Thêm loại bài tập thành công');
    }
    public function getEditExerciseType($id)
    {
        $trainer = Auth::guard('trainer')->user();
        $course_type_id = $trainer->course_type_id;
        $course_type = CourseType::find($course_type_id);
        $exercise_type = ExerciseType::find($id);
        return view('trainer.exercise_type.edit', ['exercise_type' => $exercise_type, 'course_type' => $course_type]);
    }
    public function postEditExerciseType($id, Request $request)
    {
        $this->validate($request, [
            'exercise_type_name' => 'required',
        ], [
            'exercise_type_name.required' => 'Bạn chưa nhập tên loại bài tập',
        ]);
        $exercise_type = ExerciseType::find($id);
        $exercise_type->course_type_id = $request->course_type;
        $exercise_type->exercise_type_name = $request->exercise_type_name;
        $exercise_type->save();
        return redirect()->route('trainer-list-exercise-type')->with('message', 'Thay đổi loại bài tập thành công');
    }
    public function getDeleteExerciseType($id)
    {
        $exercise_type = ExerciseType::destroy($id);
        return redirect()->route('admin-list-exercise-type')->with('message', 'Xóa loại bài tập thành công');
    }
    public function getListExercise()
    {
        $exercises = Exercise::all();
        return view('trainer.exercise.list', ['exercises' => $exercises]);
    }
    public function getAddExercise()
    {
        $trainer = Auth::guard('trainer')->user();
        $course_type_id = $trainer->course_type_id;
        $exercise_types = ExerciseType::where('course_type_id','=',$course_type_id)->get();
        return view('trainer.exercise.add', ['exercise_types' => $exercise_types, 'trainer' => $trainer]);
    }
    public function postAddExercise(Request $request)
    {
        $this->validate($request, [
            'exercise_name' => 'required|unique:exercises,exercise_name',
            'description' => 'required',
        ], [
            'exercise_name.required' => 'Bạn chưa nhập tên bài tập',
            'exercise_name.unique' => 'Tên Bài tập bạn nhập vào đã được sử dụng',
            'description.required' => 'Bạn chưa nhập vào mô tả bài tập',
        ]);
        $exercise = new Exercise;
        $exercise->exercise_type_id = $request->exercise_type;
        $exercise->exercise_name = $request->exercise_name;
        $exercise->description = $request->description;
        $exercise->trainer_id = $request->trainer;
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'mp4' && $extension != 'wmv' && $extension != 'mov' && $extension != 'flv' && $extension != 'avi') {
                return redirect()->redirect('trainer-add-exercise')->with('error', 'Chỉ hỗ trợ các loại file mp4, wmv, mov, flv, avi');
            }
            $name = $file->getClientOriginalName();
            $video = Str::random(4) . "_" . $name;
            while (file_exists("upload/exercise/video" . $video)) {
                $video = Str::random(4) . "_" . $name;
            }
            $file->move("upload/exercise/video", $video);
            $exercise->video = $video;
        } else {
            $exercise->video = "";
        }
        $exercise->save();
        return redirect()->route('trainer-list-exercise')->with('message', 'Thêm bài tập thành công');
    }
    public function getEditExercise($id)
    {
        $trainer = Auth::guard('trainer')->user();
        $course_type_id = $trainer->course_type_id;
        $exercise_types = ExerciseType::where('course_type_id','=',$course_type_id)->get();
        $exercise = Exercise::find($id);
        return view('trainer.exercise.edit', ['exercise' => $exercise, 'exercise_types' => $exercise_types, 'trainer' => $trainer]);
    }
    public function postEditExercise($id, Request $request)
    {
        $this->validate($request, [
            'exercise_name' => 'required',
            'description' => 'required',
        ], [
            'exercise_name.required' => 'Bạn chưa nhập tên bài tập',
            'description.required' => 'Bạn chưa nhập vào mô tả bài tập',
        ]);
        $exercise = Exercise::find($id);
        $exercise->exercise_type_id = $request->exercise_type;
        $exercise->exercise_name = $request->exercise_name;
        $exercise->description = $request->description;
        $exercise->trainer_id = $request->trainer;
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'mp4' && $extension != 'wmv' && $extension != 'mov' && $extension != 'flv' && $extension != 'avi') {
                return redirect()->redirect('trainer-add-exercise')->with('error', 'Chỉ hỗ trợ các loại file mp4, wmv, mov, flv, avi');
            }
            $name = $file->getClientOriginalName();
            $video = Str::random(4) . "_" . $name;
            while (file_exists("upload/exercise/video" . $video)) {
                $video = Str::random(4) . "_" . $name;
            }
            $file->move("upload/exercise/video", $video);
            unlink("upload/exercise/video/" . $exercise->video);
            $exercise->video = $video;
        }
        $exercise->save();
        return redirect()->route('trainer-list-exercise')->with('message', 'Sửa bài tập thành công');
    }
    public function getDeleteExercise($id)
    {
        $exercise = ExerciseType::find($id);
        $exercise->delete();
        return redirect()->route('trainer-list-exercise')->with('message', 'Xóa bài tập thành công');
    }
    // Manager Course
    public function getListCourse()
    {
        $today = new DateTime;
        $current = $today->format('Y-m-d H:i:s');
        $trainer_id = Auth::guard('trainer')->user()->id;
        $courses = Course::where('trainer_id','=',$trainer_id)
                        ->where('end_time','>=',$current)
                        ->orderby('created_at','DESC')
                        ->get();
        return view('trainer.course.list',['courses'=>$courses]);
    }
    public function getCourseDetail($id)
    {
        $course = Course::find($id);
        $users = User::where('course_id','=',$id)->orderBy('created_at','DESC')->get();
        return view('trainer.course.course_detail',['course'=>$course,'users'=>$users]);
    }
    public function getUserDetail($id)
    {
        $histories = HistoryUser::where('user_id','=',$id)
                                ->orderBy('created_at','DESC')
                                ->get();
        $user = User::find($id);
        $course_id = $user->course_id;
        $lessions = Lession::where('course_id','=',$course_id)->get();
        return view('trainer.users.user_detail',['user'=>$user,'histories'=>$histories,'lessions'=>$lessions]);
    }
    // ==============================================================================================

    public function getListPost()
    {
        $trainer_id = Auth::guard('trainer')->user()->id;
        $trainer_posts = TrainerPost::where('trainer_id','=',$trainer_id)
                        ->orderBy('created_at', 'DESC')->get();
        return view('trainer.trainer_post.list', ['trainer_posts' => $trainer_posts]);
    }
    public function getAddPost()
    {
        return view('trainer.trainer_post.add');
    }
    public function postAddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'preview' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'Bạn chưa nhập tên bài viết',
            'preview.required' => 'Bạn chưa nhập tóm tắt bài viết',
            'body.required' => 'Bạn chưa nhập nội dung bài viết',
        ]);
        $trainer_post = new TrainerPost;
        $trainer_post->title = $request->title;
        $trainer_post->preview = $request->preview;
        $trainer_post->body = $request->body;
        $trainer_post->trainer_id = Auth::guard('trainer')->user()->id;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('trainer-add-post')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/trainerpost/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/trainerpost/photo", $photo);
            $trainer_post->photo = $photo;
        } else {
            $trainer_post->photo = "default.jpg";
        }
        $trainer_post->save();
        return redirect()->route('trainer-list-post')->with('message', 'Thêm bài viết thành công');
    }
    public function getEditPost($id)
    {
        $trainer_post = TrainerPost::find($id);
        return view('trainer.trainer_post.edit', ['trainer_post' => $trainer_post]);
    }
    public function postEditPost($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'preview' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'Bạn chưa nhập tên bài viết',
            'preview.required' => 'Bạn chưa nhập tóm tắt bài viết',
            'body.required' => 'Bạn chưa nhập nội dung bài viết',
        ]);
        $trainer_post = TrainerPost::find($id);
        $trainer_post->title = $request->title;
        $trainer_post->preview = $request->preview;
        $trainer_post->body = $request->body;
        $trainer_post->trainer_id = Auth::guard('trainer')->user()->id;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jepg') {
                return redirect()->route('trainer-edit-post')->with('error', 'Bạn phải chọn file có dạng jpg, png, jepg');
            }
            $name = $file->getClientOriginalName();
            $photo = Str::random(4) . "_" . $name;
            while (file_exists("upload/trainerpost/photo" . $photo)) {
                $photo = Str::random(4) . "_" . $name;
            }
            $file->move("upload/trainerpost/photo", $photo);
            if($trainer_post->photo!="default.jpg"){
                unlink("upload/post/photo/" . $trainer_post->photo);
            }
            $trainer_post->photo = $photo;
        }
        $trainer_post->save();
        return redirect()->route('trainer-list-post')->with('message', 'Sửa bài viết thành công');
    }
    public function getDeletePost($id)
    {
        $trainer_post = TrainerPost::destroy($id);
        return redirect()->route('trainer-list-post')->with('message', 'Xóa bài viết thành công');
    }
    // End Post ==========================================================================
}

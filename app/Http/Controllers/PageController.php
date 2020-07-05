<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseType;
use App\Course;
use App\Trainer;
use App\Product;
use App\Post;
use App\Exercise;
use App\Lession;
use App\User;
use App\TrainerPost;
use App\ExerciseType;
use DateTime;
use Carbon\Carbon;

class PageController extends Controller
{
    public function getHome()
    {
        $lessions = Lession::all();
        $today = new DateTime;
        date_format($today, 'Y-m-d H:i:s');
        $courses = Course::where('start_time','>',$today)
                        ->take(3)
                        ->get();
        $course_types = CourseType::orderBy('created_at','DESC')
                                ->take(4)
                                ->get();
        $new_courses = Course::orderBy('created_at','DESC')
                                ->take(5)
                                ->get();
        $trainers = Trainer::all();
        $course_max_discount = Course::orderBy('discount','DESC')->first();
        $products = Product::orderBy('created_at','DESC')->take(5)->get();
        return view('pages.index',['course_types'=>$course_types,'new_courses'=>$new_courses,'trainers'=>$trainers,'course_max_discount'=>$course_max_discount,'products'=>$products,'courses'=>$courses,'lessions'=>$lessions]);
    }
    public function getCourse()
    {
        $today = new DateTime();
        $current = $today->format('Y-m-d H:i:s');
        $course_max_discount = Course::where('end_time','>=',$current)
                            ->orderBy('discount','DESC')->first();
        $courses = Course::where('end_time','>=',$current)
                            ->orderBy('created_at','DESC')->get();
        return view('pages.course',['courses'=>$courses,'course_max_discount'=>$course_max_discount]);
    }
    // Search Course ==================================================================
    public function getSearchCourse(Request $request)
    {
        $term = $request->term['term'];
        $courses = Course::where('course_name','LIKE', '%' . $term . '%')
                        ->get();
                        $response = array();
        foreach($courses as $course){
        $response[] = array(
              "id"=>$course->id,
              "text"=>$course->course_name
        );
      }

      echo json_encode($response);
      exit;
    }
    public function getResultSearchCourse($id) {
        $course = Course::find($id);
        if ($course == null) {
            abort(404);
        }
        $course_type_id = $course->course_type_id;
        $course_type = CourseType::find($course_type_id);
        return array($course,$course_type); 
    }
    //================================================================================ 
    public function getSchedule()
    {
        $lessions = Lession::all();
        $course_types = CourseType::all();
        $new_posts = Post::orderBy('created_at','DESC')->take(4)->get();
        return view('pages.schedule',['course_types'=>$course_types,'new_posts'=>$new_posts,'lessions'=>$lessions]);
    }
    public function getTrainer()
    {
        $today = new DateTime;
        date_format($today, 'Y-m-d H:i:s');
        $courses = Course::where('start_time','>',$today)
                        ->take(3)
                        ->get();
        $course_max_discount = Course::orderBy('discount','DESC')->first();
        $trainers = Trainer::orderBy('created_at','DESC')->get();
        return view('pages.trainer',['trainers'=>$trainers,'course_max_discount'=>$course_max_discount,'courses'=>$courses]);
    }
    // Search Trainer
    public function getSearchTrainer(Request $request)
    {
        $term = $request->term['term'];
        $trainers = Trainer::where('full_name','LIKE', '%' . $term . '%')
                        ->get();
                        $response = array();
        foreach($trainers as $trainer){
        $response[] = array(
              "id"=>$trainer->id,
              "text"=>$trainer->full_name
        );
      }

      echo json_encode($response);
      exit;
    }
    public function getResultSearchTrainer($id)
    {
        $trainer = Trainer::find($id);
        if ($trainer == null) {
            abort(404);
        }
        $course_type_id = $trainer->course_type_id;
        $course_type = CourseType::find($course_type_id);
        $course_type_name = $course_type->course_type_name;
        return array($trainer, $course_type_name); 
    }
    // ===============================================================================
    // Search Exercise
    public function getSearchExercise(Request $request)
    {
        $term = $request->term['term'];
        $exercises = Exercise::where('exercise_name','LIKE', '%' . $term . '%')
                        ->get();
                        $response = array();
        foreach($exercises as $exercise){
        $response[] = array(
              "id"=>$exercise->id,
              "text"=>$exercise->exercise_name
        );
      }
      echo json_encode($response);
      exit;
    }
    public function getResultSearchExercise($id)
    {
        $exercise = Exercise::find($id);
        if ($exercise == null) {
            abort(404);
        }
        $exercise_type_id = $exercise->exercise_type_id;
        $exercise_type = ExerciseType::find($exercise_type_id);
        return array($exercise, $exercise_type); 
    }
    // =================================================================================
    public function getNews()
    {
        $today = new DateTime;
        date_format($today, 'Y-m-d H:i:s');
        $courses = Course::where('start_time','>',$today)
                        ->take(3)
                        ->get();
        $course_max_discount = Course::orderBy('discount','DESC')->first();
        $course_types = CourseType::all();
        $posts = Post::orderBy('created_at','DESC')->get();
        $new_posts = Post::orderBy('created_at','DESC')->take(4)->get();
        $trainer_posts = TrainerPost::orderBy('created_at','DESC')->get();
        return view('pages.news',['posts'=>$posts,'new_posts'=>$new_posts,'course_types'=>$course_types,'course_max_discount'=>$course_max_discount,'courses'=>$courses,'trainer_posts'=>$trainer_posts]);
    }

    public function getExercise()
    {
        $today = new DateTime;
        date_format($today, 'Y-m-d H:i:s');
        $courses = Course::where('start_time','>',$today)
                        ->take(3)
                        ->get();
        $course_max_discount = Course::orderBy('discount','DESC')->first();
        $exercises = Exercise::orderBy('created_at','DESC')->get();
        return view('pages.exercise',['exercises'=> $exercises,'course_max_discount'=>$course_max_discount,'courses'=>$courses]);
    }
    public function getCourseDetail($id)
    {
        $lessions = Lession::where('course_id','=',$id)->get();
        $customers = User::where('course_id','=',$id)->get();
        $member= count($customers);
        $course = Course::find($id);
        return view('courses.course_detail',['course'=>$course,'customers'=>$customers,'lessions'=>$lessions,'member'=>$member]);
    }

    public function getProduct()
    {
        $products = Product::all();
        return view('pages.product',['products'=>$products]);
    }
}

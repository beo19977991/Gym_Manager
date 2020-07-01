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
use DateTime;

class PageController extends Controller
{
    public function getHome()
    {
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
        return view('pages.index',['course_types'=>$course_types,'new_courses'=>$new_courses,'trainers'=>$trainers,'course_max_discount'=>$course_max_discount,'products'=>$products,'courses'=>$courses]);
    }
    public function getCourse()
    {
        $course_max_discount = Course::orderBy('discount','DESC')->first();
        $courses = Course::orderBy('created_at','DESC')->get();
        return view('pages.course',['courses'=>$courses,'course_max_discount'=>$course_max_discount]);
    }
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
    public function getSearchTrainer(Request $request)
    {
        $term = $request->term;
        $trainers = Trainer::where('course_name','LIKE', '%'.$term.'%')
                            ->get();
        
        return $trainers;
    }

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
        return view('pages.news',['posts'=>$posts,'new_posts'=>$new_posts,'course_types'=>$course_types,'course_max_discount'=>$course_max_discount,'courses'=>$courses]);
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
        $course = Course::find($id);
        return view('courses.course_detail',['course'=>$course,'customers'=>$customers,'lessions'=>$lessions]);
    }

    public function getResultSearchCourse($id) {
        $course = Course::find($id);
        if ($course == null) {
            abort(404);
        }
        return $course; 
    }
}

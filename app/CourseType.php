<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $table = "course_types";

    protected $fillable= [
        'course_type_name',
        'description'
    ];

    public function course()
    {
        return $this->hasMany('App\Course','course_type_id','id');
    }
    public function trainer()
    {
        return $this->hasMany('App\Trainer','course_type_id','id');
    }
    public function exercise_type()
    {
        return $this->hasMany('App\ExerciseType','course_type_id','id');
    }
}

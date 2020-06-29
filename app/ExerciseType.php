<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseType extends Model
{
    protected $table = 'exercise_types';

    protected $fillable = [
        'exercise_type_name',
        'course_type_id',
    ];

    public function course_type()
    {
        return $this->belongsTo('App\CourseType','course_type_id','id');
    }
}

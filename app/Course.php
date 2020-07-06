<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";

    protected $fillable= [
        'course_type_id',
        'trainer_id',
        'course_name',
        'description',
        'price',
        'discount',
        'number_member',
        'number',
        'color',
        'start_time',
        'end_time'
    ];

    public function user()
    {
        return $this->hasMany('App\User','course_id','id');
    }
    public function lession()
    {
        return $this->hasMany('App\Lession','course_id','id');
    }
    public function course_type()
    {
        return $this->belongsTo('App\CourseType','course_type_id','id');
    }
    public function trainer()
    {
        return $this->belongsTo('App\Trainer','trainer_id','id');
    }
    public function history_user()
    {
        return $this->hasMany('App\HistoryUser','course_id','id');
    }
}

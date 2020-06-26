<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lession extends Model
{
    protected $table = 'lessions';

    protected $fillable = [
        'course_id',
        'start_time',
        'end_time',
    ];
    public function course()
    {
        return $this->belongsTo('App\Course','course_id','id');
    }
    
}

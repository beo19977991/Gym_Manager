<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = 'exercises';

    protected $fillable = [
        'exercise_type_id',
        'exercise_name',
        'video',
        'description'
    ];

    public function exercise_type()
    {
        return $this->belongsTo('App\ExerciseType','id','exercise_type_id');
    }
}

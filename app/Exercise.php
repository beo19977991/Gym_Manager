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
        'description',
        'trainer_id',
    ];

    public function exercise_type()
    {
        return $this->belongsTo('App\ExerciseType','exercise_type_id','id');
    }
    public function trainer()
    {
        return $this->belongsTo('App\Trainer','trainer_id','id');
    }
}

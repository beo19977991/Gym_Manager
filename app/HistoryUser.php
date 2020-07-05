<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryUser extends Model
{
    protected $table = 'history_users';

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function course()
    {

        return $this->belongsTo('App\Course','course_id','id');
    }

}

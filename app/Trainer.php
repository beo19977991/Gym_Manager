<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Trainer extends Authenticatable
{
    use Notifiable;
    protected $guard = 'trainer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_type_id',
        'full_name',
        'email',
        'password',
        'age',
        'address',
        'gender',
        'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function course()
    {
        return $this->hasMany('App\Course','trainer_id','id');
    }

    public function course_type()
    {
        return $this->belongsTo('App\CourseType', 'course_type_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    protected $fillable =[
        'staff_id',
        'title',
        'body',
        'photo',
    ];

    public function staff()
    {
        return $this->belongsTo('App\Staff','staff_id','id');
    }
}
